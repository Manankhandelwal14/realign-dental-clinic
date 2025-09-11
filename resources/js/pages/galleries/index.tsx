import React, { useCallback, useState, useMemo, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { CircleCheckBig, Eye, Pencil, Search, Trash, X, RotateCcw } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { TableHead, TableCell } from "@/components/ui/table";
import Heading from "@/components/heading";
import { type Gallery } from "@/types/gallery";
import { toast } from "sonner";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import ReorderableTable from "@/components/ReorderableTable";
import { Loader2 } from "lucide-react";
import { debounce } from "lodash";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip";
import CustomPagination from "@/components/CustomPagination";

interface GalleryProps {
    galleries: {
        data: Gallery[];
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

const Gallery: React.FC<GalleryProps> = ({ galleries, filters }) => {
    const { data: galleriesData, current_page, links, per_page } = galleries;
    const [error, setError] = useState<string | null>(null);
    const [isLoading, setIsLoading] = useState(false);
    const { delete: destroy, get } = useForm();

    const [status, setStatus] = useState<string>(filters?.status || "all");
    const [search, setSearch] = useState<string>(filters?.search || "");

    const debouncedSearch = useMemo(
        () =>
            debounce((value: string, statusValue: string) => {
                setIsLoading(true);
                get(
                    route("admin.galleries.index", {
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
        (gallery: Gallery) => {
            if (!gallery?.id) {
                toast.error("Invalid gallery data");
                return;
            }

            toast("Are you sure you want to delete this gallery item?", {
                action: {
                    label: "Yes, Delete",
                    onClick: () => {
                        destroy(route("admin.galleries.destroy", gallery.id), {
                            onError: (errors) => {
                                setError(errors.message || "Failed to delete gallery item");
                                toast.error(errors.message || "Failed to delete gallery item");
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
            route("admin.galleries.index", {
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
            route("admin.galleries.index"),
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
            <TableHead>Caption</TableHead>
            <TableHead>Featured</TableHead>
            <TableHead>Status</TableHead>
            <TableHead className="text-end">Actions</TableHead>
        </>
    );

    const renderRow = (gallery: Gallery, index: number) => (
        <>
            <TableCell className="text-center">{(current_page - 1) * per_page + index + 1}</TableCell>
            <TableCell>
                <div className="flex items-center gap-2">
                    <Avatar className="h-10 w-10">
                        <AvatarImage src={gallery.image ?? ""} alt={gallery.title} />
                        <AvatarFallback>{gallery.title.charAt(0).toUpperCase()}</AvatarFallback>
                    </Avatar>
                    <Tooltip>
                        <TooltipTrigger className="truncate text-left">{gallery.title}</TooltipTrigger>
                        <TooltipContent>
                            <span>{gallery.caption || "No caption"}</span>
                        </TooltipContent>
                    </Tooltip>
                </div>
            </TableCell>
            <TableCell>{gallery.caption || "N/A"}</TableCell>
            <TableCell>
                <div className="flex items-center justify-center">
                    {gallery.featured ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
                </div>
            </TableCell>
            <TableCell>
                <div className="flex items-center justify-center">
                    {gallery.status ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
                </div>
            </TableCell>
            <TableCell className="flex justify-end">
                <div className="flex gap-2">
                    <Button variant="outline" asChild>
                        <Link href={route("admin.galleries.show", gallery.id)}><Eye className="h-4 w-4" /></Link>
                    </Button>
                    <Button variant="outline" onClick={() => handleDelete(gallery)}><Trash className="h-4 w-4" /></Button>
                    <Button variant="outline" asChild>
                        <Link href={route("admin.galleries.edit", gallery.id)}><Pencil className="h-4 w-4" /></Link>
                    </Button>
                </div>
            </TableCell>
        </>
    );

    const renderFilters = () => (
        <div className="flex items-center gap-2 flex-wrap">
            <Select value={status} onValueChange={handleStatusChange}>
                <SelectTrigger className="w-20">
                    <SelectValue placeholder="Filter by status" />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value="active">Active</SelectItem>
                    <SelectItem value="inactive">Inactive</SelectItem>
                    <SelectItem value="featured">Featured</SelectItem>
                    <SelectItem value="all">All</SelectItem>
                </SelectContent>
            </Select>
            <div className="relative flex-1 max-w-sm">
                <Input
                    placeholder="Search by title or description"
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
                <Head title="Gallery" />
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
            <Head title="Gallery" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Gallery" description="Manage your gallery items effectively." className="mb-0" />
                    <Button asChild>
                        <Link href={route("admin.galleries.create")}>Add Gallery Item</Link>
                    </Button>
                </div>
                <div className="border rounded-lg p-4">
                    <ReorderableTable<Gallery>
                        items={galleriesData}
                        reorderRoute={route("admin.galleries.reorder")}
                        idKey="id"
                        orderKey="order"
                        renderRow={renderRow}
                        tableHeader={tableHeader}
                        filters={renderFilters()}
                        onSuccess={() => toast.success("Gallery item order updated")}
                        onError={(error) => setError(error)}
                    />
                </div>

                {galleriesData.length > 0 && (
                    <CustomPagination
                        currentPage={current_page}
                        lastPage={galleries.last_page}
                        links={links}
                    />
                )}
            </div>
        </AppLayout>
    );
};

export default Gallery;