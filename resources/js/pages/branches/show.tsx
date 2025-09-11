import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Branch } from '@/types/branch';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import Heading from '@/components/heading';
import { ChevronRight, Globe, Mail, MapPin, Phone } from 'lucide-react';
import MetaDetailsPopup from '@/components/MetaDetailsPopup';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';

interface ShowBranchProps {
    branch: Branch;
}

const ShowBranch: React.FC<ShowBranchProps> = ({ branch }) => {

    const breadcrumbs = [
        {
            title: "Dashboard",
            href: "/admin/dashboard"
        },
        {
            title: "Branches",
            href: "/admin/branches"
        },
        {
            title: branch.name,
            href: `/admin/branches/${branch.id}`
        }
    ];

    const [openMetaDetailsDialog, setOpenMetaDetailsDialog] = React.useState<boolean>(false);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Branch: ${branch.name}`} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="md:flex items-center justify-between">
                    <Heading title={branch.name} description={branch.tagline} className="mb-0" />
                    <div className="flex items-center gap-2 mt-3 md:mt-0">
                        <Button variant="outline" onClick={() => setOpenMetaDetailsDialog(true)}>Meta Details</Button>
                        <Link href={route("admin.branches.edit", branch.id)}><Button variant="outline">Edit Branch</Button></Link>
                        <Link href={route("admin.branches.content.editor", branch.id)}><Button variant="outline">Edit Content</Button></Link>
                    </div>
                </div>
                <div className='grid grid-cols-1 gap-4 md:grid-cols-4'>
                    <div className='col-span-1'>
                        <div className='space-y-4 sticky top-20'>
                            <Card className='gap-2'>
                                <CardHeader>
                                    <CardTitle>Branch Details</CardTitle>
                                    <p className="text-sm text-muted-foreground">Basic information about the branch.</p>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2">
                                        <li className='flex items-center gap-1'>
                                            <ChevronRight size={20} /><p className="text-xs hover:text-gray-500 flex items-center gap-1"><MapPin size={15} /> {branch?.address}</p>
                                        </li>
                                        <li className='flex items-center gap-1'>
                                            <ChevronRight size={20} /><p className="text-xs hover:text-gray-500 flex items-center gap-1"><Phone size={15} /> {branch?.phone ?? 'N/A'}</p>
                                        </li>
                                        <li className='flex items-center gap-1'>
                                            <ChevronRight size={20} /><p className="text-xs hover:text-gray-500 flex items-center gap-1"><Mail size={15} /> {branch?.email ?? 'N/A'}</p>
                                        </li>
                                        <li className='flex items-center gap-1'>
                                            <ChevronRight size={20} /><p className="text-xs hover:text-gray-500 flex items-center gap-1"><Globe size={15} /> {branch?.website ?? 'N/A'}</p>
                                        </li>
                                    </ul>
                                </CardContent>
                            </Card>
                            <Card className='gap-2'>
                                <CardHeader>
                                    <CardTitle>Branch Opening Hours</CardTitle>
                                    <p className="text-sm text-muted-foreground">The opening hours of the branch.</p>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-1">
                                        {branch?.opening_hours?.map((hour, index) => (
                                            <li key={index} className="text-xs flex items-center gap-1">
                                                <ChevronRight className='text-muted-foreground' size={20} />
                                                <p className='text-muted-foreground'>
                                                    <span className='text-foreground'>{hour.day.slice(0, 3)}</span> ({hour.slots.map(slot => `${slot.opening} - ${slot.closing}`).join(', ')})
                                                </p>
                                            </li>
                                        ))}
                                    </ul>
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                    <div className='col-span-3 space-y-5'>
                        <Card>
                            <CardContent>
                                <p dangerouslySetInnerHTML={{ __html: branch?.content?.html ?? 'N/A' }} />
                            </CardContent>
                        </Card>
                        {/* branch meta details */}
                        <Card>
                            <CardHeader className='border-b pb-3'>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Branch Meta Details</CardTitle>
                                        <p className="text-sm text-muted-foreground">List of meta details for this branch.</p>
                                    </div>
                                    <Button variant="outline" className="ml-auto" onClick={() => setOpenMetaDetailsDialog(true)}>Add Meta Details</Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className='space-y-2'>
                                    <div className='grid grid-cols-1 md:grid-cols-2 gap-2'>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Title</Label>
                                            <Input value={branch.meta?.title} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Description</Label>
                                            <Textarea value={branch.meta?.description} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Keywords</Label>
                                            <Textarea value={branch.meta?.keywords.join(', ')} readOnly disabled />
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                        {/* branch services */}
                        <Card>
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Branch Services</CardTitle>
                                        <p className="text-sm text-muted-foreground">List of services offered by this branch.</p>
                                    </div>
                                    <Button variant="outline" className="ml-auto" onClick={() => { /* Add service logic */ }}>Add Service</Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="flex flex-col gap-4">
                                    {branch.services && branch.services.length > 0 ? (
                                        <ul className="list-disc pl-5">
                                            {branch.services.map((service) => (
                                                <li key={service.id} className="text-sm text-muted-foreground">{service.name}</li>
                                            ))}
                                        </ul>
                                    ) : (
                                        <p className="text-sm text-muted-foreground">No services available for this branch.</p>
                                    )}
                                </div>
                            </CardContent>
                        </Card>
                        {/* teams */}
                        <Card>
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Branch Teams</CardTitle>
                                        <p className="text-sm text-muted-foreground">List of teams available in this branch.</p>
                                    </div>
                                    <Button variant="outline" className="ml-auto" onClick={() => { /* Add team logic */ }}>Add Team</Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="flex flex-col gap-4">
                                    {branch.teams && branch.teams.length > 0 ? (
                                        <ul className="list-disc pl-5">
                                            {branch.teams.map((team) => (
                                                <li key={team.id} className="text-sm text-muted-foreground">{team.name}</li>
                                            ))}
                                        </ul>
                                    ) : (
                                        <p className="text-sm text-muted-foreground">No teams available for this branch.</p>
                                    )}
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
            {/* Meta Details */}
            {branch && <MetaDetailsPopup meta={branch.meta ?? null} route={route('admin.branches.meta.update', branch?.id)} open={openMetaDetailsDialog} onOpenChange={setOpenMetaDetailsDialog} />}
        </AppLayout>
    );
};

export default ShowBranch;