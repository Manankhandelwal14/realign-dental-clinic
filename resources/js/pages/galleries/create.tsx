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
import { Gallery, GalleryRequestForm } from '@/types/gallery';
import { Loader } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Gallery',
        href: '/admin/galleries',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateGalleryProps {
    gallery?: Gallery;
}

function Create({ gallery }: CreateGalleryProps) {
    const { data, setData, post, processing, errors } = useForm<GalleryRequestForm>({
        title: gallery?.title || '',
        caption: gallery?.caption || '',
        status: gallery?.status || false,
        featured: gallery?.featured || false,
        image: null as File | null,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (gallery) {
            router.post(route('admin.galleries.update', gallery.id), {
                ...data,
                _method: 'PUT',
            });
            return;
        }

        post(route('admin.galleries.store'), {
            forceFormData: true,
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={gallery ? `Edit Gallery Item: ${gallery.title}` : 'Create Gallery Item'} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title={gallery ? `Edit Gallery Item - ${gallery.title}` : 'Create Gallery Item'} description={gallery ? `Edit the details of ${gallery.title}` : 'Create a new gallery item'} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Gallery Item Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the gallery item.
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
                                            value={data.caption}
                                            onChange={(e) => setData('caption', e.target.value)}
                                            rows={5}
                                        />
                                        <InputError message={errors.caption} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? <Loader /> : gallery ? 'Update Gallery Item' : 'Create Gallery Item'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <div className="sticky top-4">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Gallery Item Settings</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            These settings affect the status of the gallery item.
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
                                            <p className="text-sm text-gray-500">Enable or disable this gallery item</p>
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
                                            <p className="text-sm text-gray-500">Show this gallery item on the homepage</p>
                                        </div>
                                    </CardContent>
                                </Card>
                                <Card className="mt-4">
                                    <CardHeader>
                                        <CardTitle>Image</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            Upload an image for this gallery item.
                                        </p>
                                    </CardHeader>
                                    <CardContent className="space-y-5">
                                        <div className="flex items-center space-x-2">
                                            <Input
                                                id="image"
                                                type="file"
                                                accept="image/*"
                                                onChange={(e) => setData('image', e.target.files && e.target.files[0])}
                                            />
                                            <InputError message={errors.image} className="mt-2" />
                                        </div>
                                        {/* image preview */}
                                        {data.image && (
                                            <div className="mt-2">
                                                <img
                                                    src={URL.createObjectURL(data.image)}
                                                    alt="Preview"
                                                    className="w-32 h-32 object-cover rounded-md"
                                                />
                                            </div>
                                        )}
                                        {
                                            !data.image && gallery?.image && (
                                                <div className="mt-2">
                                                    <img
                                                        src={gallery.image}
                                                        alt="Current Image"
                                                        className="w-32 h-32 object-cover rounded-md"
                                                    />
                                                </div>
                                            )
                                        }
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