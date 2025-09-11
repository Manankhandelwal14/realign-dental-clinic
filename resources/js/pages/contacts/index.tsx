import React from "react";
import { Button } from "@/components/ui/button";
import { Eye, Pencil, Search, Trash } from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import { Head, Link } from "@inertiajs/react";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import Heading from "@/components/heading";
import { Contact } from "@/types/contact";
import { Pagination, PaginationContent, PaginationItem, PaginationLink, PaginationPrevious, PaginationNext } from "@/components/ui/pagination";

interface ContactsProps {
    contacts: {
        data: Contact[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        links: { url: string | null; label: string; active: boolean }[];
    };
}

const breadcrumbs = [
    {
        title: "Dashboard",
        href: "/admin/dashboard",
    },
];

const Contacts: React.FC<ContactsProps> = ({ contacts }) => {
    const { data: contactsData, current_page, links } = contacts;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Contacts" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Contacts" description="Manage your contact details effectively." className="mb-0" />
                    <Link href={route("admin.contacts.create")}><Button>Add Contacts</Button></Link>
                </div>
                {contactsData.length === 0 ? (
                    <div className="border rounded-lg shadow-sm p-8 text-center">
                        <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <Search className="w-8 h-8 text-gray-400" />
                        </div>
                        <h3 className="text-lg font-semibold text-gray-800 mb-2">No contacts found</h3>
                        <p className="text-gray-500 max-w-md mx-auto">
                            We couldn't find any contact details matching your search criteria.
                            Try adjusting your filters or search terms.
                        </p>
                    </div>
                ) : (
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead className="w-[100px]">#</TableHead>
                                <TableHead>Email</TableHead>
                                <TableHead>Phone</TableHead>
                                <TableHead>City</TableHead>
                                <TableHead>Action</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {contactsData.map((contact, index) => (
                                <TableRow key={contact.id}>
                                    <TableCell className="w-[100px]">{(current_page - 1) * contacts.per_page + index + 1}</TableCell>
                                    <TableCell>{contact.email || 'N/A'}</TableCell>
                                    <TableCell>{contact.phone || 'N/A'}</TableCell>
                                    <TableCell>{contact.city || 'N/A'}</TableCell>
                                    <TableCell className="flex gap-2">
                                        <Button variant="outline">
                                            <Eye />
                                        </Button>
                                        <Button variant="outline">
                                            <Trash />
                                        </Button>
                                        <Link href={route("admin.contacts.edit", contact.id)}>
                                            <Button variant="outline">
                                                <Pencil />
                                            </Button>
                                        </Link>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                )}
                {contactsData.length > 0 && (
                    <Pagination className="mt-8">
                        <PaginationContent>
                            <PaginationPrevious
                                href={links.find(link => link.label.includes("Previous"))?.url || "#"}
                                className={!links.find(link => link.label.includes("Previous"))?.url ? "pointer-events-none opacity-50" : ""}
                            />
                            {links
                                .filter(link => !link.label.includes("Previous") && !link.label.includes("Next"))
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
                                href={links.find(link => link.label.includes("Next"))?.url || "#"}
                                className={!links.find(link => link.label.includes("Next"))?.url ? "pointer-events-none opacity-50" : ""}
                            />
                        </PaginationContent>
                    </Pagination>
                )}
            </div>
        </AppLayout>
    );
};

export default Contacts;