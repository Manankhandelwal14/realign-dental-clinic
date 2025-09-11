import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem, User } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import React from 'react';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import Heading from '@/components/heading';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Service } from '@/types/service';
import { Reel, ReelFormRequest } from '@/types/reel';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Reels',
        href: '/admin/smile-snaps',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateReelProps {
    services: Service[];
    users: User[];
    reel: Reel;
}

function Create({ services, users, reel }: CreateReelProps) {
    const { data, setData, post, processing, errors } = useForm<ReelFormRequest>({
        title: reel?.title || '',
        caption: reel?.caption || '',
        status: reel?.status || true,
        featured: reel?.featured || false,
        service_id: reel?.service_id || null,
        user_id: reel?.user_id || null,
        date: reel?.date || null,
        video: null as File | null,
        poster: null as File | null,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (reel) {
            router.post(route('admin.smile-snaps.update', reel.id), {
                ...data,
                _method: 'PUT',
            });
            return;
        }

        post(route('admin.smile-snaps.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Reel" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title="Create Reel" description="Create a new reel" className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Reel Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the reel.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-3">
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
                                            <Label htmlFor="date" className="text-sm font-medium">
                                                Date
                                            </Label>
                                            <Input
                                                id="date"
                                                type="date"
                                                name="date"
                                                value={data.date || ''}
                                                onChange={(e) => setData('date', e.target.value || null)}
                                            />
                                            <InputError message={errors.date} className="mt-2" />
                                        </div>
                                    </div>
                                    <div>
                                        <Label htmlFor="caption" className="text-sm font-medium">
                                            Caption
                                        </Label>
                                        <Textarea
                                            id="caption"
                                            name="caption"
                                            value={data.caption}
                                            onChange={(e) => setData('caption', e.target.value)}
                                            rows={5}
                                        />
                                        <InputError message={errors.caption} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader>
                                    <CardTitle>Reel Relations</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Associate the reel with a service or user.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <Label htmlFor="service_id" className="text-sm font-medium">
                                                Service
                                            </Label>
                                            <Select
                                                onValueChange={(value) => setData('service_id', value === 'none' ? null : value)}
                                                value={data.service_id || 'none'}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Select a service" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectItem value="none">None</SelectItem>
                                                    {services.map((service) => (
                                                        <SelectItem key={service.id} value={service.id}>
                                                            {service.name}
                                                        </SelectItem>
                                                    ))}
                                                </SelectContent>
                                            </Select>
                                            <InputError message={errors.service_id} className="mt-2" />
                                        </div>
                                        <div>
                                            <Label htmlFor="user_id" className="text-sm font-medium">
                                                User
                                            </Label>
                                            <Select
                                                onValueChange={(value) => setData('user_id', value === 'none' ? null : value)}
                                                value={data.user_id || 'none'}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Select a user" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectItem value="none">None</SelectItem>
                                                    {users.map((user) => (
                                                        <SelectItem key={user.id} value={user.id}>
                                                            {user.name}
                                                        </SelectItem>
                                                    ))}
                                                </SelectContent>
                                            </Select>
                                            <InputError message={errors.user_id} className="mt-2" />
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Creating...' : 'Create Reel'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <div className='sticky top-0 space-y-4'>
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Reel Settings</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            These settings affect the status of the reel.
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
                                            <p className="text-sm text-gray-500">Enable or disable this reel</p>
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
                                            <p className="text-sm text-gray-500">Show this reel on the homepage</p>
                                        </div>
                                    </CardContent>
                                </Card>
                                <Card className="sticky top-4">
                                    <CardHeader>
                                        <CardTitle>Reels Video/Poster</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            Upload the video or poster for the reel. This is optional and can be done later.
                                        </p>
                                    </CardHeader>
                                    <CardContent className="space-y-5">
                                        <div className="space-y-2">
                                            <div>
                                                <Label htmlFor="video" className="text-sm font-medium">
                                                    Video
                                                </Label>
                                                <Input
                                                    id="video"
                                                    type="file"
                                                    name="video"
                                                    accept="video/*"
                                                    onChange={(e) => setData('video', e.target.files && e.target.files[0])}
                                                />
                                                <InputError message={errors.video} className="mt-2" />
                                            </div>
                                            <div>
                                                {
                                                    data?.video && (
                                                        <video
                                                            src={URL.createObjectURL(data.video)}
                                                            controls
                                                            className="mt-2 max-h-40 w-full object-cover rounded-md"
                                                        />
                                                    )
                                                }
                                                {
                                                    !data?.video && reel?.video && (
                                                        <video
                                                            src={reel.video}
                                                            controls
                                                            className="mt-2 max-h-40 w-full object-cover rounded-md"
                                                        />
                                                    )
                                                }
                                            </div>
                                        </div>
                                        <div className="space-y-2">
                                            <div>
                                                <Label htmlFor="poster" className="text-sm font-medium">
                                                    Poster
                                                </Label>
                                                <Input
                                                    id="poster"
                                                    type="file"
                                                    name="poster"
                                                    accept="image/*"
                                                    onChange={(e) => setData('poster', e.target.files && e.target.files[0])}
                                                />
                                                <InputError message={errors.poster} className="mt-2" />
                                            </div>
                                            <div>
                                                {
                                                    data?.poster && (
                                                        <img
                                                            src={URL.createObjectURL(data.poster)}
                                                            alt="Poster Preview"
                                                            className="mt-2 max-h-40 w-full object-cover rounded-md"
                                                        />
                                                    )
                                                }
                                                {
                                                    !data?.poster && reel?.poster && (
                                                        <img
                                                            src={reel.poster}
                                                            alt="Existing Poster"
                                                            className="mt-2 max-h-40 w-full object-cover rounded-md"
                                                        />
                                                    )
                                                }
                                            </div>
                                        </div>
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