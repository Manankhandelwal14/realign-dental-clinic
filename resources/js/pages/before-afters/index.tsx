import React, { useCallback, useState, useMemo, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { CircleCheckBig, Eye, Pencil, Search, Trash, X, RotateCcw, File } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { TableHead, TableCell } from "@/components/ui/table";
import Heading from "@/components/heading";
import { BeforeAfter } from "@/types/before-after";
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationPrevious, PaginationNext } from "@/components/ui/pagination";
import { toast } from "sonner";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import ReorderableTable from "@/components/ReorderableTable";
import { Loader2 } from "lucide-react";
import { debounce } from "lodash";

interface BeforeAftersProps {
    beforeAfters: {
        data: BeforeAfter[];
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

const BeforeAfters: React.FC<BeforeAftersProps> = ({ beforeAfters, filters }) => {
    const { data: beforeAftersData, current_page, links, per_page } = beforeAfters;
    const [isLoading, setIsLoading] = useState(false);
    const { delete: destroy, get } = useForm();

    const [status, setStatus] = useState<string>(filters?.status || "all");
    const [search, setSearch] = useState<string>(filters?.search || "");

    const debouncedSearch = useMemo(
        () =>
            debounce((value: string, statusValue: string) => {
                setIsLoading(true);
                get(
                    route("admin.before-afters.index", {
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
        (beforeAfter: BeforeAfter) => {
            if (!beforeAfter?.id) {
                toast.error("Invalid before & after data");
                return;
            }

            toast("Are you sure you want to delete this before & after entry?", {
                action: {
                    label: "Yes, Delete",
                    onClick: () => {
                        destroy(route("admin.before-afters.destroy", beforeAfter.id), {
                            onSuccess: () => toast.success("Before & After entry deleted successfully"),
                            onError: (errors) => {
                                toast.error(errors.message || "Failed to delete before & after entry");
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
            route("admin.before-afters.index", {
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
            route("admin.before-afters.index"),
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
            <TableHead>Title</TableHead>
            <TableHead>Description</TableHead>
            <TableHead>Featured</TableHead>
            <TableHead>Status</TableHead>
            <TableHead>Actions</TableHead>
        </>
    );

    const renderRow = (beforeAfter: BeforeAfter, index: number) => (
        <>
            <TableCell className="text-center">{(current_page - 1) * per_page + index + 1}</TableCell>
            <TableCell>
                <div className="flex items-center gap-2">
                    {beforeAfter.before_image && (
                        <img
                            src={beforeAfter.before_image}
                            alt="Before"
                            className="w-12 h-12 object-cover rounded mr-2"
                        />
                    )}
                    {beforeAfter.after_image && (
                        <img
                            src={beforeAfter.after_image}
                            alt="After"
                            className="w-12 h-12 object-cover rounded"
                        />
                    )}
                    {beforeAfter.title}
                </div>
            </TableCell>
            <TableCell>{beforeAfter.description}</TableCell>
            <TableCell>
                {beforeAfter.featured ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
            </TableCell>
            <TableCell>
                {beforeAfter.status ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
            </TableCell>
            <TableCell>
                <div className="flex gap-2">
                    <Button variant="outline" asChild>
                        <Link href={route("admin.before-afters.show", beforeAfter.id)}><Eye className="h-4 w-4" /></Link>
                    </Button>
                    <Button variant="outline" onClick={() => handleDelete(beforeAfter)}><Trash className="h-4 w-4" /></Button>
                    <Button variant="outline" asChild>
                        <Link href={route("admin.before-afters.edit", beforeAfter.id)}><Pencil className="h-4 w-4" /></Link>
                    </Button>
                    <Button variant="outline" asChild>
                        <Link href={route("admin.before-afters.content.editor", beforeAfter.id)}><File className="h-4 w-4" /></Link>
                    </Button>
                </div>
            </TableCell>
        </>
    );

    const renderFilters = () => (
        <div className="flex items-center gap-2 flex-wrap">
            <Select value={status} onValueChange={handleStatusChange}>
                <SelectTrigger className="w-[130px]">
                    <SelectValue placeholder="Filter by status" />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value="active">Active</SelectItem>
                    <SelectItem value="inactive">Inactive</SelectItem>
                    <SelectItem value="featured">Featured</SelectItem>
                    <SelectItem value="deleted">Deleted</SelectItem>
                    <SelectItem value="all">All</SelectItem>
                </SelectContent>
            </Select>
            <div className="relative flex-1 max-w-sm">
                <Input
                    placeholder="Search by title, description"
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
                {isLoading ? <Loader2 className="absolute left-2 top-1/2 transform -translate-y-1/2 h-4 w-4 animate-spin" /> : (<Search className="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" size={18} />)}
            </div>
            {(filters?.search || filters?.status) && (
                <Button variant="outline" onClick={resetFilters}>
                    <RotateCcw className="h-4 w-4" />
                    Reset Filters
                </Button>
            )}
        </div>
    );

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Before & After" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Before & After" description="Manage your before & after entries effectively." className="mb-0" />
                    <Button asChild>
                        <Link href={route("admin.before-afters.create")}>Add Before & After</Link>
                    </Button>
                </div>
                <div className="border rounded-lg p-4">
                    <ReorderableTable<BeforeAfter>
                        items={beforeAftersData}
                        reorderRoute={route("admin.before-afters.reorder")}
                        idKey="id"
                        orderKey="order"
                        renderRow={renderRow}
                        tableHeader={tableHeader}
                        filters={renderFilters()}
                        onSuccess={() => toast.success("Before & After order updated")}
                    />
                </div>

                {beforeAftersData.length > 0 && (
                    <Pagination className="mt-8">
                        <PaginationContent>
                            <PaginationPrevious
                                href={links.find((link) => link.label.includes("Previous"))?.url || "#"}
                                className={!links.find((link) => link.label.includes("Previous"))?.url ? "pointer-events-none opacity-50" : ""}
                            />
                            {links
                                .filter((link) => !link.label.includes("Previous") && !link.label.includes("Next"))
                                .map((link, index) => (
                                    <PaginationItem key={index}>
                                        <PaginationLink
                                            href={link.url || "#"}
                                            isActive={link.active}
                                            className={link.url ? "" : "pointer-events-none opacity-50"}
                                        >
                                            {link.label}
                                        </PaginationLink>
                                    </PaginationItem>
                                ))}
                            <PaginationNext
                                href={links.find((link) => link.label.includes("Next"))?.url || "#"}
                                className={!links.find((link) => link.label.includes("Next"))?.url ? "pointer-events-none opacity-50" : ""}
                            />
                        </PaginationContent>
                    </Pagination>
                )}
            </div>
        </AppLayout>
    );
};

export default BeforeAfters;