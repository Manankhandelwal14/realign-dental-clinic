import React from 'react';
import { BreadcrumbItem } from '@/types';
import Heading from '@/components/heading';
import { Category, CategoryRequestForm } from '@/types/category';
import AppLayout from '@/layouts/app-layout';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { Switch } from '@/components/ui/switch';
import { Head, router, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Categories',
        href: '/admin/categories',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateCategoryProps {
    categories: Category[];
    category: Category | null;
}

function Create({ categories, category }: CreateCategoryProps) {
    const { data, setData, post, processing, errors } = useForm<CategoryRequestForm>({
        name: category?.name || '',
        sort_description: category?.sort_description || '',
        description: category?.description || '',
        status: category?.status || true,
        featured: category?.featured || false,
        parent_id: category?.parent_id || null,
        banner: null,
    });


    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (category) {
            router.post(route('admin.categories.update', category.id), {
                _method: 'put',
                ...data,
            });
            return;
        }

        post(route('admin.categories.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={category ? 'Edit Category' : 'Create Category'} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title={category ? 'Edit Category' : 'Create Category'} description={category ? 'Edit an existing category' : 'Create a new category'} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Basic Info</CardTitle>
                                    <p className="text-sm text-gray-500">Basic information about the category.</p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div className="col-span-1 md:col-span-1">
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
                                        <div className="col-span-1 md:col-span-2">
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
                                    <div>
                                        <Label htmlFor="description" className="text-sm font-medium">
                                            Description
                                        </Label>
                                        <Textarea
                                            id="description"
                                            name="description"
                                            value={data.description}
                                            onChange={(e) => setData('description', e.target.value)}
                                            rows={4}
                                        />
                                        <InputError message={errors.description} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader>
                                    <CardTitle>Category Relations</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Associate the category with a branch or parent category.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <Label htmlFor="parent_id" className="text-sm font-medium">
                                        Parent Category
                                    </Label>
                                    <Select
                                        onValueChange={(value) => setData('parent_id', value === 'none' ? null : value)}
                                        value={data.parent_id || undefined}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select a parent category" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="none">Select a parent category</SelectItem>
                                            {categories.map((category) => (
                                                <SelectItem key={category.id} value={category.id}>
                                                    {category.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.parent_id} className="mt-2" />
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {
                                        processing ? (
                                            <span className="loader"></span>
                                        ) : (
                                            category ? 'Update Category' : 'Create Category'
                                        )
                                    }
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <Card className="sticky top-4">
                                <CardHeader>
                                    <CardTitle>Category Settings</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        These settings affect the status of the category.
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
                                        <p className="text-sm text-gray-500">Enable or disable this category</p>
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
                                        <p className="text-sm text-gray-500">Show this category on the homepage</p>
                                    </div>
                                </CardContent>
                            </Card>
                            {/* banner */}
                            <Card className="mt-4">
                                <CardHeader>
                                    <CardTitle>Banner</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Upload a banner image for this category.
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
                                    </div>
                                    <InputError message={errors.banner} className="mt-2" />
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}

export default Create;