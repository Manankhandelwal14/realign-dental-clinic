import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import React from 'react';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import Heading from '@/components/heading';
import { BeforeAfter, BeforeAfterFormRequest } from '@/types/before-after';
import { Loader } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Before & After',
        href: '/admin/before-afters',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateProps {
    beforeAfter?: BeforeAfter;
}

const Create: React.FC<CreateProps> = ({ beforeAfter }) => {
    const { data, setData, post, processing, errors } = useForm<BeforeAfterFormRequest>({
        title: beforeAfter?.title || '',
        description: beforeAfter?.description || '',
        before_image: null,
        after_image: null,
        status: beforeAfter?.status || true,
        featured: beforeAfter?.featured || false,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (beforeAfter) {
            router.post(route('admin.before-afters.update', beforeAfter.id), {
                ...data,
                _method: 'PUT',
            });
            return;
        }

        post(route('admin.before-afters.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={beforeAfter ? "Edit Before & After" : "Create Before & After"} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title={beforeAfter ? "Edit Before & After" : "Create Before & After"} description={beforeAfter ? "Edit the before & after entry" : "Create a new before & after entry"} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Before & After Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the before & after entry.
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
                            <Card>
                                <CardHeader>
                                    <CardTitle>Images</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Upload before and after images for this entry.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <div>
                                                <Label htmlFor="before_image" className="text-sm font-medium">
                                                    Before Image
                                                </Label>
                                                <Input
                                                    id="before_image"
                                                    type="file"
                                                    accept="image/*"
                                                    onChange={(e) => setData('before_image', e.target.files && e.target.files[0])}
                                                />
                                                <InputError message={errors.before_image} className="mt-2" />
                                            </div>
                                            <div>
                                                {data.before_image && (
                                                    <img
                                                        src={URL.createObjectURL(data.before_image)}
                                                        alt="Before"
                                                        className="mt-2 w-full h-auto rounded-md"
                                                    />
                                                )}
                                                {
                                                    !data.before_image && beforeAfter?.before_image && (
                                                        <img
                                                            src={beforeAfter.before_image}
                                                            alt="Before"
                                                            className="mt-2 w-full h-auto rounded-md"
                                                        />
                                                    )
                                                }
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <Label htmlFor="after_image" className="text-sm font-medium">
                                                    After Image
                                                </Label>
                                                <Input
                                                    id="after_image"
                                                    type="file"
                                                    accept="image/*"
                                                    onChange={(e) => setData('after_image', e.target.files && e.target.files[0])}
                                                />
                                                <InputError message={errors.after_image} className="mt-2" />
                                            </div>
                                            <div>
                                                {data.after_image && (
                                                    <img
                                                        src={URL.createObjectURL(data.after_image)}
                                                        alt="After"
                                                        className="mt-2 w-full h-auto rounded-md"
                                                    />
                                                )}
                                                {
                                                    !data.after_image && beforeAfter?.after_image && (
                                                        <img
                                                            src={beforeAfter.after_image}
                                                            alt="After"
                                                            className="mt-2 w-full h-auto rounded-md"
                                                        />
                                                    )
                                                }
                                            </div>
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>Cancel</Button>
                                <Button type="submit" disabled={processing}>{processing ? <Loader /> : beforeAfter ? "Update Before & After" : "Create Before & After"}</Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <Card className="sticky top-4">
                                <CardHeader>
                                    <CardTitle>Before & After Settings</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">These settings affect the status of the before & after entry.</p>
                                </CardHeader>
                                <CardContent className="space-y-5">
                                    <div className="space-y-2">
                                        <div className="flex items-center space-x-2">
                                            <Switch id="status" checked={data.status} onCheckedChange={(checked) => setData('status', checked)} />
                                            <Label htmlFor="status">Status</Label>
                                        </div>
                                        <p className="text-sm text-gray-500">Enable or disable this entry</p>
                                    </div>
                                    <div className="space-y-2">
                                        <div className="flex items-center space-x-2">
                                            <Switch id="featured" checked={data.featured} onCheckedChange={(checked) => setData('featured', checked)} />
                                            <Label htmlFor="featured">Featured</Label>
                                        </div>
                                        <p className="text-sm text-gray-500">Show this entry on the homepage</p>
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

export default Create;