import React, { useCallback, useState, useMemo, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { CircleCheckBig, Eye, Pencil, Search, Trash, X, RotateCcw, File, ChevronRight } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { TableHead, TableCell } from "@/components/ui/table";
import Heading from "@/components/heading";
import { Team } from "@/types/team";
import { toast } from "sonner";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import ReorderableTable from "@/components/ReorderableTable";
import { Loader2 } from "lucide-react";
import { debounce } from "lodash";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip";
import CustomPagination from "@/components/CustomPagination";

interface TeamsProps {
    teams: {
        data: Team[];
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

const Teams: React.FC<TeamsProps> = ({ teams, filters }) => {
    const { data: teamsData, current_page, links, per_page } = teams;
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
                    route("admin.teams.index", {
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
        (team: Team) => {
            if (!team?.id) {
                toast.error("Invalid team member data");
                return;
            }

            toast("Are you sure you want to delete this team member?", {
                action: {
                    label: "Yes, Delete",
                    onClick: () => {
                        destroy(route("admin.teams.destroy", team.id), {
                            onSuccess: () => toast.success("Team member deleted successfully"),
                            onError: (errors) => {
                                setError(errors.message || "Failed to delete team member");
                                toast.error(errors.message || "Failed to delete team member");
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
            route("admin.teams.index", {
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
            route("admin.teams.index"),
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
            <TableHead>Designation</TableHead>
            <TableHead>Featured</TableHead>
            <TableHead>Status</TableHead>
            <TableHead className="text-end">Actions</TableHead>
        </>
    );

    const renderRow = (team: Team, index: number) => (
        <>
            <TableCell className="text-center">{(current_page - 1) * per_page + index + 1}</TableCell>
            <TableCell>
                <div className="flex items-center gap-2">
                    <Avatar className="h-10 w-10">
                        <AvatarImage src={team.image ?? ""} alt={team.name} />
                        <AvatarFallback>{team.name.charAt(0).toUpperCase()}</AvatarFallback>
                    </Avatar>
                    <Tooltip>
                        <TooltipTrigger className="truncate text-left">{team.name}</TooltipTrigger>
                        <TooltipContent>
                            <span>{team.sort_description}</span>
                            <div className="flex items-center gap-2 mt-2">
                                <ChevronRight size={15} />
                                <p className="text-sm">Branch - {team.branch?.name || "N/A"}</p>
                            </div>
                        </TooltipContent>
                    </Tooltip>
                </div>
            </TableCell>
            <TableCell>{team.designation || "N/A"}</TableCell>
            <TableCell>
                <div className="flex items-center justify-center">
                    {team.featured ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
                </div>
            </TableCell>
            <TableCell>
                <div className="flex items-center justify-center">
                    {team.status ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
                </div>
            </TableCell>
            <TableCell className="flex justify-end">
                <div className="flex gap-2">
                    <Button variant="outline" asChild>
                        <Link href={route("admin.teams.show", team.id)}><Eye className="h-4 w-4" /></Link>
                    </Button>
                    <Button variant="outline" onClick={() => handleDelete(team)}><Trash className="h-4 w-4" /></Button>
                    <Button variant="outline" asChild>
                        <Link href={route("admin.teams.edit", team.id)}><Pencil className="h-4 w-4" /></Link>
                    </Button>
                    <Button variant="outline" asChild>
                        <Link href={route("admin.teams.content.editor", team.id)}><File className="h-4 w-4" /></Link>
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
                    <SelectItem value="deleted">Deleted</SelectItem>
                    <SelectItem value="all">All</SelectItem>
                </SelectContent>
            </Select>
            <div className="relative flex-1 max-w-sm">
                <Input
                    placeholder="Search by name, designation, branch"
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
                <Head title="Teams" />
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
            <Head title="Teams" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Teams" description="Manage your team members effectively." className="mb-0" />
                    <Button asChild>
                        <Link href={route("admin.teams.create")}>Add Team</Link>
                    </Button>
                </div>
                <div className="border rounded-lg p-4">
                    <ReorderableTable<Team>
                        items={teamsData}
                        reorderRoute={route("admin.teams.reorder")}
                        idKey="id"
                        orderKey="order"
                        renderRow={renderRow}
                        tableHeader={tableHeader}
                        filters={renderFilters()}
                        onSuccess={() => toast.success("Team member order updated")}
                        onError={(error) => setError(error)}
                    />
                </div>

                {teamsData.length > 0 && (
                    <CustomPagination
                        currentPage={current_page}
                        lastPage={teams.last_page}
                        links={links}
                    />
                )}
            </div>
        </AppLayout>
    );
};

export default Teams;