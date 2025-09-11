import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import React from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import Heading from '@/components/heading';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Branch } from '@/types/branch';
import { Category } from '@/types/category';
import { Service, ServiceRequestForm } from '@/types/service';
import { Loader } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Services',
        href: '/admin/services',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateServiceProps {
    branches: Branch[];
    categories: Category[];
    service?: Service;
}

function Create({ branches, categories, service }: CreateServiceProps) {

    const { data, setData, post, processing, errors } = useForm<ServiceRequestForm>({
        name: service?.name || '',
        sort_description: service?.sort_description || '',
        price: service?.price || null,
        status: service?.status || false,
        featured: service?.featured || false,
        branch_id: service?.branch_id || null,
        category_id: service?.category_id || null,
        banner: null,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (service) {
            router.post(route('admin.services.update', service.id), {
                ...data,
                _method: 'PUT',
            });

            return;
        }

        post(route('admin.services.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={service ? "Edit Service" : "Create Service"} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title={service ? "Edit Service" : "Create Service"} description={service ? 'Edit the service details' : 'Create a new service'} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Service Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the service.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div className='col-span-1 md:col-span-1'>
                                            <Label htmlFor="name" className="text-sm font-medium">
                                                Name
                                            </Label>
                                            <Input
                                                id="name"
                                                type="text"
                                                name="name"
                                                value={data.name}
                                                onChange={(e) => setData('name', e.target.value)}
                                            />
                                            <InputError message={errors.name} className="mt-2" />
                                        </div>
                                        <div className='col-span-1 md:col-span-2'>
                                            <Label htmlFor="sort_description" className="text-sm font-medium">
                                                Short Description
                                            </Label>
                                            <Input
                                                id="sort_description"
                                                name="sort_description"
                                                value={data.sort_description}
                                                onChange={(e) => setData('sort_description', e.target.value)}
                                            />
                                            <InputError message={errors.sort_description} className="mt-2" />
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader>
                                    <CardTitle>Service Relations</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Associate the service with a branch or category.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <Label htmlFor="branch_id" className="text-sm font-medium">
                                                Branch
                                            </Label>
                                            <Select
                                                onValueChange={(value) => setData('branch_id', value === 'none' ? null : value)}
                                                value={data.branch_id || 'none'}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Select a branch" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {branches.map((branch) => (
                                                        <SelectItem key={branch.id} value={branch.id}>
                                                            {branch.name}
                                                        </SelectItem>
                                                    ))}
                                                </SelectContent>
                                            </Select>
                                            <InputError message={errors.branch_id} className="mt-2" />
                                        </div>
                                        <div>
                                            <Label htmlFor="category_id" className="text-sm font-medium">Category</Label>
                                            <Select
                                                onValueChange={(value) => setData('category_id', value === 'none' ? null : value)}
                                                value={data.category_id || 'none'}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Select a category" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    {categories.map((category) => (
                                                        <SelectItem key={category.id} value={category.id}>
                                                            {category.name}
                                                        </SelectItem>
                                                    ))}
                                                </SelectContent>
                                            </Select>
                                            <InputError message={errors.category_id} className="mt-2" />
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? <Loader /> : service ? 'Update Service' : 'Create Service'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <div className="sticky top-4">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Service Settings</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            These settings affect the status of the service.
                                        </p>
                                    </CardHeader>
                                    <CardContent className="space-y-5">
                                        <div className="space-y-2">
                                            <div className="flex items-center space-x-2">
                                                <Switch
                                                    id="status"
                                                    checked={data.status}
                                                    onCheckedChange={(checked) => setData('status', checked)}
                                                />
                                                <Label htmlFor="status">Status</Label>
                                            </div>
                                            <p className="text-sm text-gray-500">Enable or disable this service</p>
                                        </div>
                                        <div className="space-y-2">
                                            <div className="flex items-center space-x-2">
                                                <Switch
                                                    id="featured"
                                                    checked={data.featured}
                                                    onCheckedChange={(checked) => setData('featured', checked)}
                                                />
                                                <Label htmlFor="featured">Featured</Label>
                                            </div>
                                            <p className="text-sm text-gray-500">Show this service on the homepage</p>
                                        </div>
                                    </CardContent>
                                </Card>
                                <Card className="mt-4">
                                    <CardHeader>
                                        <CardTitle>Banner</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            Upload a banner image for this service.
                                        </p>
                                    </CardHeader>
                                    <CardContent className="space-y-5">
                                        <div className="flex items-center space-x-2">
                                            <Input
                                                id="banner"
                                                type="file"
                                                accept="image/*"
                                                onChange={(e) => setData('banner', e.target.files && e.target.files[0])}
                                            />
                                            <InputError message={errors.banner} className="mt-2" />
                                        </div>
                                        {/* preview */}
                                        {data.banner && (
                                            <div className="mt-4">
                                                <img
                                                    src={URL.createObjectURL(data.banner)}
                                                    alt="Banner Preview"
                                                    className="w-full h-auto rounded-md"
                                                />
                                            </div>
                                        )}
                                        {
                                            !data.banner && service?.banner && (
                                                <div className="mt-4">
                                                    <img
                                                        src={service.banner}
                                                        alt="Banner Preview"
                                                        className="w-full h-auto rounded-md"
                                                    />
                                                </div>
                                            )
                                        }
                                    </CardContent>
                                </Card>
                                {/* pricing */}
                                <Card className="mt-4">
                                    <CardHeader>
                                        <CardTitle>Pricing</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            Set the pricing for this service.
                                        </p>
                                    </CardHeader>
                                    <CardContent className="space-y-5">
                                        <div className="flex items-center space-x-2">
                                            <Input
                                                id="price"
                                                type="number"
                                                step="0.1"
                                                value={data?.price || ''}
                                                onChange={(e) => setData('price', parseFloat(e.target.value) || null)}
                                                placeholder="0.00"
                                            />
                                        </div>
                                        <InputError message={errors.price} className="mt-2" />
                                    </CardContent>
                                </Card>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}

export default Create;