import React, { useCallback, useState, useMemo, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { CircleCheckBig, Eye, Pencil, Search, Trash, X, RotateCcw, File, ChevronRight } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { TableHead, TableCell } from "@/components/ui/table";
import Heading from "@/components/heading";
import { Branch } from "@/types/branch";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { toast } from "sonner";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import ReorderableTable from "@/components/ReorderableTable";
import { Loader2 } from "lucide-react";
import { debounce } from "lodash";
import { Tooltip, TooltipTrigger, TooltipContent } from "@/components/ui/tooltip";
import CustomPagination from "@/components/CustomPagination";

interface BranchesProps {
    branches: {
        data: Branch[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        links: { url: string | null; label: string; active: boolean }[];
    };
    filters?: {
        search?: string;
        status?: string;
    };
}

const breadcrumbs = [{ title: "Dashboard", href: "/admin/dashboard" }];

const Branches: React.FC<BranchesProps> = ({ branches, filters }) => {
    const { data: branchesData, current_page, links, per_page } = branches;
    const [error, setError] = useState<string | null>(null);
    const [isLoading, setIsLoading] = useState(false);
    const { delete: destroy, get } = useForm();

    const [status, setStatus] = useState<string>(filters?.status || "active");
    const [search, setSearch] = useState<string>(filters?.search || "");

    const debouncedSearch = useMemo(() =>
        debounce((value: string, statusValue: string) => {
            setIsLoading(true);
            get(
                route("admin.branches.index", {
                    search: value,
                    status: statusValue,
                }),
                {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true,
                    onFinish: () => setIsLoading(false),
                }
            );
        }, 300),
        [get, setIsLoading]
    );

    const handleDelete = useCallback(
        (branch: Branch) => {
            if (!branch?.id) {
                toast.error("Invalid branch data");
                return;
            }

            toast("Are you sure you want to delete this branch?", {
                action: {
                    label: "Yes, Delete",
                    onClick: () => {
                        destroy(route("admin.branches.destroy", branch.id), {
                            onSuccess: () => toast.success("Branch deleted successfully"),
                            onError: (errors) => {
                                setError(errors.message || "Failed to delete branch");
                                toast.error(errors.message || "Failed to delete branch");
                            },
                        });
                    },
                },
            });
        },
        [destroy]
    );

    const handleSearch = () => {
        debouncedSearch(search, status);
    };

    const handleStatusChange = (value: string) => {
        setStatus(value);
        setIsLoading(true);
        get(
            route("admin.branches.index", {
                status: value,
                search,
            }),
            {
                preserveScroll: true,
                replace: true,
                onFinish: () => setIsLoading(false),
            }
        );
    };

    useEffect(() => {
        return () => {
            debouncedSearch.cancel();
        };
    }, [debouncedSearch]);

    const resetFilters = () => {
        setSearch("");
        setStatus("all");
        setIsLoading(true);
        get(
            route("admin.branches.index"),
            {
                preserveScroll: true,
                replace: true,
                onFinish: () => setIsLoading(false),
            }
        );
    };

    const tableHeader = (
        <>
            <TableHead className="text-center">#</TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Address</TableHead>
            <TableHead>Featured</TableHead>
            <TableHead>Status</TableHead>
            <TableHead>Actions</TableHead>
        </>
    );

    const renderRow = (branch: Branch, index: number) => (
        <>
            <TableCell className="text-center">{(current_page - 1) * per_page + index + 1}</TableCell>
            <TableCell>
                <Tooltip>
                    <TooltipTrigger>
                        <div className="flex items-center gap-2">
                            <Avatar className="h-10 w-10">
                                <AvatarImage src={branch.banner ?? ""} alt={branch.name} />
                                <AvatarFallback>{branch.name.charAt(0).toUpperCase()}</AvatarFallback>
                            </Avatar>
                            <span>{branch.name}</span>
                        </div>
                    </TooltipTrigger>
                    <TooltipContent>
                        <div className="flex items-center gap-2">
                            <ChevronRight size={15} />
                            <p className="text-sm">{branch.tagline}</p>
                        </div>
                        <div className="flex items-center gap-2">
                            <ChevronRight size={15} />
                            <p className="text-sm">{branch.address}</p>
                        </div>
                        <div className="flex items-center gap-2">
                            <ChevronRight size={15} />
                            <p className="text-sm">Meta Title - {branch?.meta?.title ?? 'N/A'}</p>
                        </div>
                        <div className="flex items-center gap-2">
                            <ChevronRight size={15} />
                            <p className="text-sm">Meta Description - {branch?.meta?.description ?? 'N/A'}</p>
                        </div>
                        <div className="flex items-center gap-2">
                            <ChevronRight size={15} />
                            <p className="text-sm">Meta Keywords - {branch?.meta?.keywords?.join(', ') ?? 'N/A'}</p>
                        </div>
                        <div className="flex items-center gap-2">
                            <ChevronRight size={15} />
                            <p className="text-sm">Meta Tags - {branch?.meta?.tags?.map(tag => `${tag.key}: ${tag.value}`)?.join(', ') ?? 'N/A'}</p>
                        </div>
                    </TooltipContent>
                </Tooltip>
            </TableCell>
            <TableCell>{branch.address}</TableCell>
            <TableCell>
                {branch.featured ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
            </TableCell>
            <TableCell>
                {branch.status ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
            </TableCell>
            <TableCell>
                {
                    branch?.deleted_at ? (
                        <div className="flex gap-2">
                            <Button variant="destructive" onClick={() => handleDelete(branch)}><Trash className="h-4 w-4" /></Button>
                            <Link href={route("admin.branches.restore", branch.id)}>
                                <Button variant="outline">Restore</Button>
                            </Link>
                        </div>
                    ) : (
                        <div className="flex gap-2">
                            <Button variant="outline" asChild>
                                <Link href={route("admin.branches.show", branch.id)}><Eye className="h-4 w-4" /></Link>
                            </Button>
                            <Button variant="outline" asChild>
                                <Link href={route("admin.branches.content.editor", branch.id)}><File className="h-4 w-4" /></Link>
                            </Button>
                            <Button variant="outline" asChild><Link href={route("admin.branches.edit", branch.id)}><Pencil className="h-4 w-4" /></Link></Button>
                            <Button variant="outline" onClick={() => handleDelete(branch)}><Trash className="h-4 w-4" /></Button>
                        </div>
                    )
                }
            </TableCell>
        </>
    );

    const renderFilters = () => (
        <div className="flex items-center gap-2 flex-wrap">
            <Select value={status} onValueChange={handleStatusChange}>
                <SelectTrigger className="w-28">
                    <SelectValue placeholder="Filter by status" />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value="active">Active</SelectItem>
                    <SelectItem value="inactive">Inactive</SelectItem>
                    <SelectItem value="featured">Featured</SelectItem>
                    <SelectItem value="unfeatured">Unfeatured</SelectItem>
                    <SelectItem value="deleted">Deleted</SelectItem>
                    <SelectItem value="all">All</SelectItem>
                </SelectContent>
            </Select>
            <div className="relative flex-1 max-w-sm">
                <Input
                    placeholder="Search by name, tagline"
                    className="pl-8"
                    value={search}
                    onChange={(e) => setSearch(e.target.value)}
                    onKeyDown={(e) => {
                        if (e.key === "Enter") {
                            handleSearch();
                        }
                    }}
                    disabled={isLoading}
                />
                {isLoading ? (
                    <Loader2 className="absolute left-2 top-1/2 transform -translate-y-1/2 h-4 w-4 animate-spin" />
                ) : (
                    <Search className="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" size={18} />
                )}
            </div>
            {(filters?.search || filters?.status) && (
                <Button variant="outline" onClick={resetFilters}>
                    <RotateCcw className="h-4 w-4" />
                    Reset Filters
                </Button>
            )}
        </div>
    );

    if (error) {
        return (
            <AppLayout breadcrumbs={breadcrumbs}>
                <Head title="Branches" />
                <div className="p-4">
                    <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong className="font-bold">Error: </strong>
                        <span className="block sm:inline">{error}</span>
                    </div>
                </div>
            </AppLayout>
        );
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Branches" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Branches" description="Manage your branches effectively." className="mb-0" />
                    <Link href={route("admin.branches.create")}><Button>Add Branch</Button></Link>
                </div>
                <div className="border rounded-lg p-4">
                    <ReorderableTable<Branch>
                        items={branchesData}
                        reorderRoute={route("admin.branches.reorder")}
                        idKey="id"
                        orderKey="order"
                        renderRow={renderRow}
                        tableHeader={tableHeader}
                        filters={renderFilters()}
                        onSuccess={() => toast.success("Branch order updated")}
                        onError={(error) => setError(error)}
                    />
                </div>

                {branchesData.length > 0 && (
                    <CustomPagination
                        currentPage={current_page}
                        lastPage={branches.last_page}
                        links={links}
                    />
                )}
            </div>
        </AppLayout>
    );
};

export default Branches;