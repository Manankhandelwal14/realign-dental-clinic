import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import React from 'react';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import Heading from '@/components/heading';
import { Feature } from '@/types/feature';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Features',
        href: '/admin/features',
    },
    {
        title: 'Edit',
        href: '#',
    },
];

interface EditFeatureProps {
    feature: Feature;
}

function Edit({ feature }: EditFeatureProps) {
    const { data, setData, put, processing, errors } = useForm<{
        title: string;
        description: string;
        status: boolean;
        featured: boolean;
    }>({
        title: feature.title || '',
        description: feature.description || '',
        status: feature.status || false,
        featured: feature.featured || false,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.features.update', feature.id));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Feature" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title="Edit Feature" description={`Edit Feature - ${feature.title}`} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Feature Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the feature.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div>
                                        <Label htmlFor="title" className="text-sm font-medium">
                                            Title
                                        </Label>
                                        <Input
                                            id="title"
                                            type="text"
                                            name="title"
                                            value={data.title}
                                            onChange={(e) => setData('title', e.target.value)}
                                        />
                                        <InputError message={errors.title} className="mt-2" />
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
                                            rows={5}
                                        />
                                        <InputError message={errors.description} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Updating...' : 'Update Feature'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <Card className="sticky top-4">
                                <CardHeader>
                                    <CardTitle>Feature Settings</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        These settings affect the status of the feature.
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
                                        <p className="text-sm text-gray-500">Enable or disable this feature</p>
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
                                        <p className="text-sm text-gray-500">Show this feature on the homepage</p>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}

export default Edit;