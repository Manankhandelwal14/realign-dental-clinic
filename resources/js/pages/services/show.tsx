import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import Heading from '@/components/heading';
import { Service } from '@/types/service';
import { ChevronRight } from 'lucide-react';
import MetaDetailsPopup from '@/components/MetaDetailsPopup';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';

interface ShowServiceProps {
    service: Service;
}

const ShowService: React.FC<ShowServiceProps> = ({ service }) => {

    const [openMetaDetailsDialog, setOpenMetaDetailsDialog] = React.useState<boolean>(false);
    const breadcrumbs = [
        {
            title: "Dashboard",
            href: "/admin/dashboard"
        },
        {
            title: "Services",
            href: "/admin/services"
        },
        {
            title: service.name,
            href: `/admin/services/${service.id}`
        }
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Service: ${service.name}`} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="md:flex items-center justify-between">
                    <Heading title={service.name} description={service.sort_description ?? 'N/A'} className="mb-0" />
                    <div className="flex items-center gap-2 mt-3 md:mt-0">
                        <Link href={route("admin.services.edit", service.id)}><Button variant="outline">Edit Profile</Button></Link>
                    </div>
                </div>
                <div className='grid grid-cols-1 gap-4 md:grid-cols-4'>
                    <div className='col-span-1'>
                        <div className='space-y-4 sticky top-20'>
                            <Card className='gap-2'>
                                <CardHeader>
                                    <div className='text-center space-y-2'>
                                        <div className="flex items-center justify-center">
                                            <img src={service.banner ?? ''} alt={service.name} className="w-25 h-25 rounded-full" />
                                        </div>
                                        <div className='space-y-2'>
                                            <CardTitle>{service?.name}</CardTitle>
                                            <p className="text-sm text-muted-foreground">{service?.sort_description ?? 'N/A'}</p>
                                        </div>
                                        <ul className="space-y-2 border-t pt-2">
                                            <li className='flex items-center gap-1'><ChevronRight size={20} /><p className="text-xs hover:text-gray-500 flex items-center gap-1">Branch - {service?.branch?.name ?? 'N/A'}</p></li>
                                            <li className='flex items-center gap-1'><ChevronRight size={20} /><p className="text-xs hover:text-gray-500 flex items-center gap-1">Category - {service?.category?.name ?? 'N/A'}</p></li>
                                            <li className='flex items-center gap-1'><ChevronRight size={20} /><p className="text-xs hover:text-gray-500 flex items-center gap-1">Price - {service?.price ?? 'N/A'}</p></li>
                                        </ul>
                                    </div>
                                </CardHeader>
                            </Card>
                        </div>
                    </div>
                    <div className='col-span-3 space-y-5'>
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
                                            <Input value={service.meta?.title ?? 'N/A'} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Description</Label>
                                            <Textarea value={service.meta?.description ?? 'N/A'} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Keywords</Label>
                                            <Textarea value={service.meta?.keywords.join(', ') ?? 'N/A'} readOnly disabled />
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                        <Card>
                            <CardContent>
                                <p dangerouslySetInnerHTML={{ __html: service?.content?.html ?? 'N/A' }} />
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
            {/* Meta Details */}
            {service && <MetaDetailsPopup meta={service?.meta ?? null} route={route('admin.services.meta.update', service?.id)} open={openMetaDetailsDialog} onOpenChange={setOpenMetaDetailsDialog} />}
        </AppLayout>
    );
};

export default ShowService;