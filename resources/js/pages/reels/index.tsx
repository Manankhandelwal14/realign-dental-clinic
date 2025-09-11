import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { Reel } from '@/types/reel';
import { Head, Link } from '@inertiajs/react';
import React, { useState } from 'react'
import ReelPlayer from './player';
import { Pencil, Trash } from 'lucide-react';

interface ReelsProps {
    reels: {
        data: Reel[];
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

const SmileSnaps: React.FC<ReelsProps> = ({ reels, filters }) => {

    const { data: reelsData, current_page, links, per_page } = reels;

    const [selectedReel, setSelectedReel] = useState<Reel | null>(null);

    const handleReelClick = (reel: Reel) => {
        setSelectedReel(reel);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Reels" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Reels" description="Manage your reels effectively." className="mb-0" />
                    <Button asChild>
                        <Link href={route("admin.smile-snaps.create")}>Add Reel</Link>
                    </Button>
                </div>
                <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    {
                        reelsData?.map((reel, index) => (
                            <div key={index} className="relative rounded-lg overflow-hidden cursor-pointer group hover:scale-105 transition-transform duration-300"
                                onClick={() => handleReelClick(reel)}
                            >
                                <div className="aspect-[9/16] bg-gray-200 relative">
                                    <img src={reel.poster}
                                        alt={reel.title} className="w-full h-full object-cover" />
                                    <div className='absolute top-1 right-3 gap-2 hidden group-hover:flex z-10'>
                                        <Link href={route('admin.smile-snaps.edit', reel.id)}><Button size="icon"><Pencil /></Button></Link>
                                        <Button variant="destructive"><Trash /></Button>
                                    </div>
                                </div>  
                                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-3">
                                    <div className="text-white">
                                        <p className="text-sm font-medium">{reel.title}</p>
                                        <div className="flex items-center text-xs mt-1">
                                            <i className="ri-heart-line mr-1"></i>
                                            <span>2.5K</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))
                    }
                </div>
            </div>

            {selectedReel && (
                <ReelPlayer
                    reels={reelsData}
                    initialReel={selectedReel}
                    onClose={() => setSelectedReel(null)}
                />
            )}

        </AppLayout>
    )
}

export default SmileSnaps

// import React, { useCallback, useState, useMemo, useEffect } from "react";
// import { Button } from "@/components/ui/button";
// import { CircleCheckBig, Eye, Pencil, Search, Trash, X, RotateCcw } from "lucide-react";
// import AppLayout from "@/layouts/app-layout";
// import { Head, Link, useForm } from "@inertiajs/react";
// import { TableHead, TableCell } from "@/components/ui/table";
// import Heading from "@/components/heading";
// import { Reel } from "@/types/reel";
// import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationPrevious, PaginationNext } from "@/components/ui/pagination";
// import { toast } from "sonner";
// import { Input } from "@/components/ui/input";
// import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
// import ReorderableTable from "@/components/ReorderableTable";
// import { Loader2 } from "lucide-react";
// import { debounce } from "lodash";

// interface ReelsProps {
//     reels: {
//         data: Reel[];
//         current_page: number;
//         last_page: number;
//         per_page: number;
//         total: number;
//         links: { url: string | null; label: string; active: boolean }[];
//     };
//     filters?: {
//         search?: string;
//         status?: string;
//     };
// }

// const breadcrumbs = [{ title: "Dashboard", href: "/dashboard" }];

// const Reels: React.FC<ReelsProps> = ({ reels, filters }) => {
//     const { data: reelsData, current_page, links, per_page } = reels;
//     const [error, setError] = useState<string | null>(null);
//     const [isLoading, setIsLoading] = useState(false);
//     const { delete: destroy, get } = useForm();

//     const [status, setStatus] = useState<string>(filters?.status || "all");
//     const [search, setSearch] = useState<string>(filters?.search || "");

//     const debouncedSearch = useMemo(
//         () =>
//             debounce((value: string, statusValue: string) => {
//                 setIsLoading(true);
//                 get(
//                     route("smile-snaps.index", {
//                         search: value,
//                         status: statusValue,
//                     }),
//                     {
//                         preserveState: true,
//                         preserveScroll: true,
//                         replace: true,
//                         onFinish: () => setIsLoading(false),
//                     }
//                 );
//             }, 300),
//         [get, setIsLoading]
//     );

//     const handleDelete = useCallback(
//         (reel: Reel) => {
//             if (!reel?.id) {
//                 toast.error("Invalid reel data");
//                 return;
//             }

//             toast("Are you sure you want to delete this reel?", {
//                 action: {
//                     label: "Yes, Delete",
//                     onClick: () => {
//                         destroy(route("smile-snaps.destroy", reel.id), {
//                             onSuccess: () => toast.success("Reel deleted successfully"),
//                             onError: (errors) => {
//                                 setError(errors.message || "Failed to delete reel");
//                                 toast.error(errors.message || "Failed to delete reel");
//                             },
//                         });
//                     },
//                 },
//             });
//         },
//         [destroy]
//     );

//     const handleSearch = () => {
//         debouncedSearch(search, status);
//     };

//     const handleStatusChange = (value: string) => {
//         setStatus(value);
//         setIsLoading(true);
//         get(
//             route("smile-snaps.index", {
//                 status: value,
//                 search,
//             }),
//             {
//                 preserveScroll: true,
//                 replace: true,
//                 onFinish: () => setIsLoading(false),
//             }
//         );
//     };

//     useEffect(() => {
//         return () => {
//             debouncedSearch.cancel();
//         };
//     }, [debouncedSearch]);

//     const resetFilters = () => {
//         setSearch("");
//         setStatus("all");
//         setIsLoading(true);
//         get(
//             route("smile-snaps.index"),
//             {
//                 preserveScroll: true,
//                 replace: true,
//                 onFinish: () => setIsLoading(false),
//             }
//         );
//     };

//     const tableHeader = (
//         <>
//             <TableHead className="text-center">#</TableHead>
//             <TableHead>Title</TableHead>
//             <TableHead>Description</TableHead>
//             <TableHead>Service</TableHead>
//             <TableHead>User</TableHead>
//             <TableHead>Featured</TableHead>
//             <TableHead>Status</TableHead>
//             <TableHead>Actions</TableHead>
//         </>
//     );

//     const renderRow = (reel: Reel, index: number) => (
//         <>
//             <TableCell className="text-center">{(current_page - 1) * per_page + index + 1}</TableCell>
//             <TableCell>{reel.title}</TableCell>
//             <TableCell>{reel.caption || "N/A"}</TableCell>
//             <TableCell>{reel.service?.name || "N/A"}</TableCell>
//             <TableCell>{reel.user?.name || "N/A"}</TableCell>
//             <TableCell>
//                 {reel.featured ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
//             </TableCell>
//             <TableCell>
//                 {reel.status ? <CircleCheckBig className="text-green-500" /> : <X className="text-red-500" />}
//             </TableCell>
//             <TableCell>
//                 <div className="flex gap-2">
//                     <Button variant="outline" asChild>
//                         <Link href={route("smile-snaps.show", reel.id)}><Eye className="h-4 w-4" /></Link>
//                     </Button>
//                     <Button variant="outline" onClick={() => handleDelete(reel)}><Trash className="h-4 w-4" /></Button>
//                     <Button variant="outline" asChild>
//                         <Link href={route("smile-snaps.edit", reel.id)}><Pencil className="h-4 w-4" /></Link>
//                     </Button>
//                 </div>
//             </TableCell>
//         </>
//     );

//     const renderFilters = () => (
//         <div className="flex items-center gap-2 flex-wrap">
//             <Select value={status} onValueChange={handleStatusChange}>
//                 <SelectTrigger className="w-[130px]">
//                     <SelectValue placeholder="Filter by status" />
//                 </SelectTrigger>
//                 <SelectContent>
//                     <SelectItem value="active">Active</SelectItem>
//                     <SelectItem value="inactive">Inactive</SelectItem>
//                     <SelectItem value="featured">Featured</SelectItem>
//                     <SelectItem value="deleted">Deleted</SelectItem>
//                     <SelectItem value="all">All</SelectItem>
//                 </SelectContent>
//             </Select>
//             <div className="relative flex-1 max-w-sm">
//                 <Input
//                     placeholder="Search by title, description, service, user"
//                     className="pl-8"
//                     value={search}
//                     onChange={(e) => setSearch(e.target.value)}
//                     onKeyDown={(e) => {
//                         if (e.key === "Enter") {
//                             handleSearch();
//                         }
//                     }}
//                     disabled={isLoading}
//                 />
//                 {isLoading ? (
//                     <Loader2 className="absolute left-2 top-1/2 transform -translate-y-1/2 h-4 w-4 animate-spin" />
//                 ) : (
//                     <Search className="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" size={18} />
//                 )}
//             </div>
//             {(filters?.search || filters?.status) && (
//                 <Button variant="outline" onClick={resetFilters}>
//                     <RotateCcw className="h-4 w-4" />
//                     Reset Filters
//                 </Button>
//             )}
//         </div>
//     );

//     if (error) {
//         return (
//             <AppLayout breadcrumbs={breadcrumbs}>
//                 <Head title="Reels" />
//                 <div className="p-4">
//                     <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
//                         <strong className="font-bold">Error: </strong>
//                         <span className="block sm:inline">{error}</span>
//                     </div>
//                 </div>
//             </AppLayout>
//         );
//     }

//     return (
//         <AppLayout breadcrumbs={breadcrumbs}>
//             <Head title="Reels" />
//             <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
//                 <div className="flex items-center justify-between">
//                     <Heading title="Reels" description="Manage your reels effectively." className="mb-0" />
//                     <Button asChild>
//                         <Link href={route("smile-snaps.create")}>Add Reel</Link>
//                     </Button>
//                 </div>
//                 <div className="border rounded-lg p-4">
//                     <ReorderableTable<Reel>
//                         items={reelsData}
//                         reorderRoute={route("reels.reorder")}
//                         idKey="id"
//                         orderKey="order"
//                         renderRow={renderRow}
//                         tableHeader={tableHeader}
//                         filters={renderFilters()}
//                         onSuccess={() => toast.success("Reel order updated")}
//                         onError={(error) => setError(error)}
//                     />
//                 </div>

//                 {reelsData.length > 0 && (
//                     <Pagination className="mt-8">
//                         <PaginationContent>
//                             <PaginationPrevious
//                                 href={links.find((link) => link.label.includes("Previous"))?.url || "#"}
//                                 className={!links.find((link) => link.label.includes("Previous"))?.url ? "pointer-events-none opacity-50" : ""}
//                             />
//                             {links
//                                 .filter((link) => !link.label.includes("Previous") && !link.label.includes("Next"))
//                                 .map((link, index) => (
//                                     <PaginationItem key={index}>
//                                         <PaginationLink
//                                             href={link.url || "#"}
//                                             isActive={link.active}
//                                             className={link.url ? "" : "pointer-events-none opacity-50"}
//                                         >
//                                             {link.label}
//                                         </PaginationLink>
//                                     </PaginationItem>
//                                 ))}
//                             <PaginationNext
//                                 href={links.find((link) => link.label.includes("Next"))?.url || "#"}
//                                 className={!links.find((link) => link.label.includes("Next"))?.url ? "pointer-events-none opacity-50" : ""}
//                             />
//                         </PaginationContent>
//                     </Pagination>
//                 )}
//             </div>
//         </AppLayout>
//     );
// };

// export default Reels;