import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import Heading from '@/components/heading';
import { Category } from '@/types/category';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import MetaDetailsPopup from '@/components/MetaDetailsPopup';

interface ShowCategoryProps {
    category: Category;
}

const ShowCategory: React.FC<ShowCategoryProps> = ({ category }) => {

    const [openMetaDetailsDialog, setOpenMetaDetailsDialog] = React.useState<boolean>(false);
    const breadcrumbs = [
        {
            title: "Dashboard",
            href: "/admin/dashboard"
        },
        {
            title: "Categories",
            href: "/admin/categories"
        },
        {
            title: category.name,
            href: `/admin/categories/${category.id}`
        }
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Category: ${category.name}`} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="md:flex items-center justify-between">
                    <Heading title={category.name} description={category.sort_description ?? 'N/A'} className="mb-0" />
                    <div className="flex items-center gap-2 mt-3 md:mt-0">
                        <Link href={route("admin.categories.edit", category.id)}><Button variant="outline">Edit Category</Button></Link>
                    </div>
                </div>
                <div className='grid grid-cols-1 gap-4 md:grid-cols-4'>
                    <div className='col-span-1'>
                        <div className='space-y-4 sticky top-20'>
                            <Card className='gap-2'>
                                <CardHeader>
                                    <CardTitle>Category Details</CardTitle>
                                    <p className="text-sm text-muted-foreground">Basic information about the category.</p>
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
                                        <CardTitle>Category Meta Details</CardTitle>
                                        <p className="text-sm text-muted-foreground">List of meta details for this category.</p>
                                    </div>
                                    <Button variant="outline" className="ml-auto" onClick={() => setOpenMetaDetailsDialog(true)}>Add Meta Details</Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className='space-y-2'>
                                    <div className='grid grid-cols-1 md:grid-cols-2 gap-2'>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Title</Label>
                                            <Input value={category.meta?.title ?? 'N/A'} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Description</Label>
                                            <Textarea value={category.meta?.description ?? 'N/A'} readOnly disabled />
                                        </div>
                                        <div className='col-span-2'>
                                            <Label className='text-sm font-semibold'>Meta Keywords</Label>
                                            <Textarea value={category.meta?.keywords.join(', ') ?? 'N/A'} readOnly disabled />
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                        <Card>
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Category Services</CardTitle>
                                        <p className="text-sm text-muted-foreground">List of services offered by this category.</p>
                                    </div>
                                    <Button variant="outline" className="ml-auto" onClick={() => { /* Add service logic */ }}>Add Service</Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="flex flex-col gap-4">
                                    {category.services && category.services.length > 0 ? (
                                        <ul className="list-disc pl-5">
                                            {category.services.map((service) => (
                                                <li key={service.id} className="text-sm text-muted-foreground">{service.name}</li>
                                            ))}
                                        </ul>
                                    ) : (
                                        <p className="text-sm text-muted-foreground">No services available for this category.</p>
                                    )}
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
            {category && <MetaDetailsPopup meta={category.meta ?? null} route={route('admin.categories.meta.update', category?.id)} open={openMetaDetailsDialog} onOpenChange={setOpenMetaDetailsDialog} />}
        </AppLayout>
    );
};

export default ShowCategory;