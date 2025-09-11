import React, { useCallback, useState, useMemo, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { CircleCheckBig, Eye, Pencil, Search, Trash, X, RotateCcw, File, ChevronRight } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { TableHead, TableCell } from "@/components/ui/table";
import Heading from "@/components/heading";
import { Service } from "@/types/service";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { toast } from "sonner";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import ReorderableTable from "@/components/ReorderableTable";
import { Loader2 } from "lucide-react";
import { debounce } from "lodash";
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip";
import CustomPagination from "@/components/CustomPagination";

interface ServicesProps {
    services: {
        data: Service[];
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

const Services: React.FC<ServicesProps> = ({ services, filters }) => {
    const { data: servicesData, current_page, links, per_page } = services;
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
                    route("admin.services.index", {
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
        (service: Service) => {
            if (!service?.id) {
                toast.error("Invalid service data");
                return;
            }

            toast("Are you sure you want to delete this service?", {
                action: {
                    label: "Yes, Delete",
                    onClick: () => {
                        destroy(route("admin.services.destroy", service.id), {
                            onSuccess: () => toast.success("Service deleted successfully"),
                            onError: (errors) => {
                                setError(errors.message || "Failed to delete service");
                                toast.error(errors.message || "Failed to delete service");
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
            route("admin.services.index", {
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
            route("admin.services.index"),
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
            <TableHead>Price</TableHead>
            <TableHead>Featured</TableHead>
            <TableHead>Status</TableHead>
            <TableHead className="text-end">Actions</TableHead>
        </>
    );

    const renderRow = (service: Service, index: number) => (
        <>
            <TableCell>{(current_page - 1) * per_page + index + 1}</TableCell>
            <TableCell>
                <div className="flex items-center gap-2 w-96">
                    <Avatar className="h-10 w-10">
                        <AvatarImage src={service.banner ?? ""} alt={service.name} />
                        <AvatarFallback>{service.name.charAt(0).toUpperCase()}</AvatarFallback>
                    </Avatar>
                    <Tooltip>
                        <TooltipTrigger className="w-96 truncate text-left">{service.name}</TooltipTrigger>
                        <TooltipContent>
                            <div className="flex items-center gap-2 mb-1">
                                <p className="text-sm">{service.sort_description}</p>
                            </div>
                            <div className="flex items-center gap-2">
                                <ChevronRight size={15} />
                                <p className="text-sm">Branch - {service.branch?.name || "N/A"}</p>
                            </div>
                            <div className="flex items-center gap-2">
                                <ChevronRight size={15} />
                                <p className="text-sm">Category - {service.category?.name || "N/A"}</p>
                            </div>
                        </TooltipContent>
                    </Tooltip>
                </div>
            </TableCell>
            <TableCell>{service.price ? `$${service.price}` : "N/A"}</TableCell>
            <TableCell>{service.featured ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}</TableCell>
            <TableCell>{service.status ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}</TableCell>
            <TableCell className="flex justify-end">
                {
                    service?.deleted_at ? (
                        <div className="flex gap-2">
                            <Button variant="outline" onClick={() => handleDelete(service)}><Trash className="h-4 w-4" /></Button>
                        </div>
                    ) : (
                        <div className="flex gap-2">
                            <Button variant="outline" asChild><Link href={route("admin.services.show", service.id)}><Eye className="h-4 w-4" /></Link></Button>
                            <Button variant="outline" asChild><Link href={route("admin.services.content.editor", service.id)}><File className="h-4 w-4" /></Link></Button>
                            <Button variant="outline" asChild><Link href={route("admin.services.edit", service.id)}><Pencil className="h-4 w-4" /></Link></Button>
                            <Button variant="outline" onClick={() => handleDelete(service)}><Trash className="h-4 w-4" /></Button>
                        </div>
                    )
                }
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
                    <SelectItem value="unfeatured">Unfeatured</SelectItem>
                    <SelectItem value="deleted">Deleted</SelectItem>
                    <SelectItem value="all">All</SelectItem>
                </SelectContent>
            </Select>
            <div className="relative flex-1 max-w-sm">
                <Input
                    placeholder="Search ..."
                    className="pl-8"
                    value={search}
                    onChange={(e) => setSearch(e.target.value)}
                    onKeyDown={(e) => { if (e.key === "Enter") { handleSearch(); } }}
                    disabled={isLoading}
                />
                {isLoading ? (
                    <Loader2 className="absolute left-2 top-1/2 transform -translate-y-1/2 h-4 w-4 animate-spin" />
                ) : (
                    <Search className="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" size={18} />
                )}
            </div>
            {(filters?.search || filters?.status) && (
                <Button variant="outline" onClick={resetFilters}><RotateCcw className="h-4 w-4" />Reset Filters</Button>
            )}
        </div>
    );

    if (error) {
        return (
            <AppLayout breadcrumbs={breadcrumbs}>
                <Head title="Services" />
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
            <Head title="Services" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Treatments" description="Manage your treatments effectively." className="mb-0" />
                    <Button asChild>
                        <Link href={route("admin.services.create")}>Add Service</Link>
                    </Button>
                </div>
                <div className="border rounded-lg p-4">
                    <ReorderableTable<Service>
                        items={servicesData}
                        reorderRoute={route("admin.services.reorder")}
                        idKey="id"
                        orderKey="order"
                        renderRow={renderRow}
                        tableHeader={tableHeader}
                        filters={renderFilters()}
                        onSuccess={() => toast.success("Service order updated")}
                        onError={(error) => setError(error)}
                    />
                </div>

                {servicesData.length > 0 && (
                    <CustomPagination
                        currentPage={current_page}
                        lastPage={services.last_page}
                        links={links}
                    />
                )}
            </div>
        </AppLayout>
    );
};

export default Services;