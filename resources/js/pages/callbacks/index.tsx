import React, { useCallback, useState, useMemo, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { Eye, Pencil, Search, Trash, RotateCcw } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { TableHead, TableCell, Table, TableHeader, TableRow, TableBody } from "@/components/ui/table";
import Heading from "@/components/heading";
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationPrevious, PaginationNext } from "@/components/ui/pagination";
import { toast } from "sonner";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Loader2 } from "lucide-react";
import { debounce } from "lodash";
import { Callback } from "@/types/callback";
import ChangeStatus from "./changeStatus";

interface CallbacksProps {
    callbacks: {
        data: Callback[];
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

const Callbacks: React.FC<CallbacksProps> = ({ callbacks, filters }) => {
    const { data: callbacksData, current_page, links, per_page } = callbacks;
    const [isLoading, setIsLoading] = useState(false);
    const { delete: destroy, get } = useForm();

    const [status, setStatus] = useState<string>(filters?.status || "pending");
    const [search, setSearch] = useState<string>(filters?.search || "");

    const debouncedSearch = useMemo(() =>
        debounce((value: string, statusValue: string) => {
            setIsLoading(true);
            get(
                route("admin.callbacks.index", {
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
        (callback: Callback) => {
            if (!callback?.id) {
                toast.error("Invalid callback data");
                return;
            }

            toast("Are you sure you want to delete this callback?", {
                action: {
                    label: "Yes, Delete",
                    onClick: () => {
                        destroy(route("admin.callbacks.destroy", callback.id), {
                            onSuccess: () => toast.success("Callback deleted successfully"),
                            onError: (errors) => {
                                toast.error(errors.message || "Failed to delete callback");
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
            route("admin.callbacks.index", {
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
            route("admin.callbacks.index"),
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
            <TableHead>Phone</TableHead>
            <TableHead>Time</TableHead>
            <TableHead>Created At</TableHead>
            <TableHead>Status</TableHead>
            <TableHead>Actions</TableHead>
        </>
    );

    const renderRow = (callback: Callback, index: number) => (
        <>
            <TableCell className="text-center">{(current_page - 1) * per_page + index + 1}</TableCell>
            <TableCell>{callback.name}</TableCell>
            <TableCell>{callback.phone}</TableCell>
            <TableCell>{callback.time ?? 'N/A'}</TableCell>
            <TableCell>{callback.created_at ?? 'N/A'}</TableCell>
            <TableCell>{
                <ChangeStatus callback={callback} />
            }</TableCell>
            <TableCell>
                <div className="flex gap-2">
                    <Button variant="outline" asChild>
                        <Link href={route("admin.callbacks.show", callback.id)}><Eye className="h-4 w-4" /></Link>
                    </Button>
                    <Button variant="outline" onClick={() => handleDelete(callback)}><Trash className="h-4 w-4" /></Button>
                    <Button variant="outline" asChild>
                        <Link href={route("admin.callbacks.edit", callback.id)}><Pencil className="h-4 w-4" /></Link>
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
                    <SelectItem value="pending">Pending</SelectItem>
                    <SelectItem value="completed">Completed</SelectItem>
                    <SelectItem value="failed">Failed</SelectItem>
                    <SelectItem value="deleted">Deleted</SelectItem>
                    <SelectItem value="all">All</SelectItem>
                </SelectContent>
            </Select>
            <div className="relative flex-1 max-w-sm">
                <Input
                    placeholder="Search by name, phone"
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

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Callbacks" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Callbacks" description="Manage callback requests effectively." className="mb-0" />
                    <Button asChild>
                        <Link href={route("admin.callbacks.create")}>Add Callback</Link>
                    </Button>
                </div>
                <div className="border rounded-lg p-4">
                    <div className="mb-4 flex items-center justify-between">
                        <h2 className="text-lg font-semibold">Filters</h2>
                        {renderFilters()}
                    </div>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                {tableHeader}
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {callbacksData.map((callback, index) => (
                                <tr key={callback.id}>{renderRow(callback, index)}</tr>
                            ))}
                            {callbacksData.length === 0 && (
                                <tr>
                                    <td colSpan={6} className="text-center py-4">
                                        No callbacks found.
                                    </td>
                                </tr>
                            )}
                        </TableBody>
                    </Table>
                </div>

                {callbacksData.length > 0 && (
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
        </AppLayout >
    );
};

export default Callbacks;