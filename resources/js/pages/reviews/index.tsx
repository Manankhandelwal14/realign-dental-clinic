import React, { useCallback, useState, useMemo, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { CircleCheckBig, Eye, Pencil, Search, Trash, X, RotateCcw } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { TableHead, TableCell } from "@/components/ui/table";
import Heading from "@/components/heading";
import { Review } from "@/types/review";
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationPrevious, PaginationNext } from "@/components/ui/pagination";
import { toast } from "sonner";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import ReorderableTable from "@/components/ReorderableTable";
import { Loader2 } from "lucide-react";
import { debounce } from "lodash";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";

interface ReviewsProps {
    reviews: {
        data: Review[];
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

const breadcrumbs = [{ title: "Dashboard", href: "/dashboard" }];

const Reviews: React.FC<ReviewsProps> = ({ reviews, filters }) => {
    const { data: reviewsData, current_page, links, per_page } = reviews;
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
                    route("admin.reviews.index", {
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
        (review: Review) => {
            if (!review?.id) {
                toast.error("Invalid review data");
                return;
            }

            toast("Are you sure you want to delete this review?", {
                action: {
                    label: "Yes, Delete",
                    onClick: () => {
                        destroy(route("reviews.destroy", review.id), {
                            onSuccess: () => toast.success("Review deleted successfully"),
                            onError: (errors) => {
                                setError(errors.message || "Failed to delete review");
                                toast.error(errors.message || "Failed to delete review");
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
            route("admin.reviews.index", {
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
            route("admin.reviews.index"),
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
            <TableHead>Author</TableHead>
            <TableHead>Rating</TableHead>
            <TableHead>Content</TableHead>
            <TableHead>Service</TableHead>
            <TableHead>User</TableHead>
            <TableHead>Featured</TableHead>
            <TableHead>Status</TableHead>
            <TableHead>Actions</TableHead>
        </>
    );

    const renderRow = (review: Review, index: number) => (
        <>
            <TableCell className="text-center">{(current_page - 1) * per_page + index + 1}</TableCell>
            <TableCell>
                <div className="flex items-center gap-2">
                    <Avatar className="h-10 w-10">
                        <AvatarImage src={review.image ?? ""} alt={review.author} />
                        <AvatarFallback>{review.author.charAt(0).toUpperCase()}</AvatarFallback>
                    </Avatar>
                    {review.author}
                </div>
            </TableCell>
            <TableCell>{review.rating}/5</TableCell>
            <TableCell>
                <p className="w-96 truncate">{review.content || "N/A"}</p>
            </TableCell>
            <TableCell>{review.service?.name || "N/A"}</TableCell>
            <TableCell>{review.user?.name || "N/A"}</TableCell>
            <TableCell>
                {review.featured ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
            </TableCell>
            <TableCell>
                {review.status ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
            </TableCell>
            <TableCell>
                <div className="flex gap-2">
                    <Button variant="outline" asChild>
                        <Link href={route("admin.reviews.show", review.id)}><Eye className="h-4 w-4" /></Link>
                    </Button>
                    <Button variant="outline" onClick={() => handleDelete(review)}><Trash className="h-4 w-4" /></Button>
                    <Button variant="outline" asChild>
                        <Link href={route("admin.reviews.edit", review.id)}><Pencil className="h-4 w-4" /></Link>
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
                    placeholder="Search by author, comment, service, user"
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
                <Head title="Reviews" />
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
            <Head title="Reviews" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Reviews" description="Manage your reviews effectively." className="mb-0" />
                    <Button asChild>
                        <Link href={route("admin.reviews.create")}>Add Review</Link>
                    </Button>
                </div>
                <div className="border rounded-lg p-4">
                    <ReorderableTable<Review>
                        items={reviewsData}
                        reorderRoute={route("admin.reviews.reorder")}
                        idKey="id"
                        orderKey="order"
                        renderRow={renderRow}
                        tableHeader={tableHeader}
                        filters={renderFilters()}
                        onSuccess={() => toast.success("Review order updated")}
                        onError={(error) => setError(error)}
                    />
                </div>

                {reviewsData.length > 0 && (
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

export default Reviews;