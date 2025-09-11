import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { Head, useForm } from '@inertiajs/react';
import React from 'react';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import Heading from '@/components/heading';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Service } from '@/types/service';
import { Branch } from '@/types/branch';

const breadcrumbs = [
    { title: 'Dashboard', href: '/admin/dashboard' },
    { title: 'YouTube Videos', href: '/admin/youtube-videos' },
    { title: 'Create', href: '#' },
];

interface CreateVideoProps {
    services: Service[];
    branches: Branch[];
}

const Create: React.FC<CreateVideoProps> = ({ services, branches }) => {
    const { data, setData, post, processing, errors } = useForm<{
        title: string;
        description: string;
        video_id: string;
        video_url: string;
        published_at: string;
        status: boolean;
        featured: boolean;
        service_id: string | null;
        branch_id: string | null;
        thumbnail: File | null;
    }>({
        title: '',
        description: '',
        video_id: '',
        video_url: '',
        published_at: '',
        status: true,
        featured: false,
        service_id: null,
        branch_id: null,
        thumbnail: null,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.youtube-videos.store'));
    };

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        // get video id from url
        const url = e.target.value;
        const videoId = url.split('v=')[1]?.split('&')[0];
        if (videoId) {
            setData('video_id', videoId);
        }
        setData('video_url', url);
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create YouTube Video" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title="Create YouTube Video" description="Add a new YouTube video" className='mb-0' />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className='grid grid-cols-1 md:grid-cols-12 gap-4'>
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Video Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the YouTube video.
                                    </p>
                                </CardHeader>
                                <CardContent className='space-y-2'>
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <Label htmlFor="title" className="text-sm font-medium">Title</Label>
                                            <Input id="title" type="text" name="title" value={data.title} placeholder="e.g., My YouTube Video" onChange={(e) => setData('title', e.target.value)} />
                                            <InputError message={errors.title} className="mt-2" />
                                        </div>
                                        <div>
                                            <Label htmlFor="published_at" className="text-sm font-medium">Published At</Label>
                                            <Input id="published_at" type="datetime-local" name="published_at" value={data.published_at} onChange={(e) => setData('published_at', e.target.value)} />
                                            <InputError message={errors.published_at} className="mt-2" />
                                        </div>
                                    </div>
                                    <div className='grid grid-cols-1 md:grid-cols-2 gap-6'>
                                        <div className="col-span-1">
                                            <Label htmlFor="video_id" className="text-sm font-medium">
                                                YouTube Url
                                            </Label>
                                            <Input id="video_url" type="text" name="video_url" value={data.video_url} onChange={(e) => handleInputChange(e)} placeholder="e.g., https://www.youtube.com/watch?v=dQw4w9WgXcQ"
                                            />
                                            <InputError message={errors.video_id} className="mt-2" />
                                        </div>
                                        <div>
                                            <Label htmlFor="video_id" className="text-sm font-medium">
                                                Youtube Video ID
                                            </Label>
                                            <Input id="video_id" type="text" name="video_id" value={data.video_id} onChange={(e) => handleInputChange(e)} placeholder="e.g., dQw4w9WgXcQ"
                                            />
                                            <InputError message={errors.video_id} className="mt-2" />
                                        </div>
                                    </div>
                                    <div>
                                        <Label htmlFor="description" className="text-sm font-medium">
                                            Description
                                        </Label>
                                        <Textarea id="description" name="description" value={data.description} onChange={(e) => setData('description', e.target.value)} rows={4} />
                                        <InputError message={errors.description} className="mt-2" />
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
                                                value={data.service_id || ''}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Select a service" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectGroup>
                                                        <SelectLabel>Services</SelectLabel>
                                                        {services.map((service) => (
                                                            <SelectItem key={service.id} value={service.id}>
                                                                {service.name}
                                                            </SelectItem>
                                                        ))}
                                                    </SelectGroup>
                                                </SelectContent>
                                            </Select>
                                            <InputError message={errors.service_id} className="mt-2" />
                                        </div>
                                        <div>
                                            <Label htmlFor="branch_id" className="text-sm font-medium">
                                                Branch
                                            </Label>
                                            <Select
                                                onValueChange={(value) => setData('branch_id', value === 'none' ? null : value)}
                                                value={data.branch_id || ''}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Select a branch" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectGroup>
                                                        <SelectLabel>Branches</SelectLabel>
                                                        {branches.map((branch) => (
                                                            <SelectItem key={branch.id} value={branch.id}>
                                                                {branch.name}
                                                            </SelectItem>
                                                        ))}
                                                    </SelectGroup>
                                                </SelectContent>
                                            </Select>
                                            <InputError message={errors.branch_id} className="mt-2" />
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Creating...' : 'Create Video'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <div className='sticky top-4 space-y-4'>
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Youtube Video Settings</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            Settings for the YouTube video.
                                        </p>
                                    </CardHeader>
                                    <CardContent className='space-y-3'>
                                        <div className='space-y-2'>
                                            <div className="flex items-center space-x-2">
                                                <Switch
                                                    id="status"
                                                    checked={data.status}
                                                    onCheckedChange={(checked) => setData('status', checked)}
                                                />
                                                <Label htmlFor="status">Status</Label>
                                            </div>
                                            <p className='text-sm text-gray-500'>Enable or disable this video</p>
                                        </div>
                                        <div className='space-y-2'>
                                            <div className="flex items-center space-x-2">
                                                <Switch
                                                    id="featured"
                                                    checked={data.featured}
                                                    onCheckedChange={(checked) => setData('featured', checked)}
                                                />
                                                <Label htmlFor="featured">Featured</Label>
                                            </div>
                                            <p className='text-sm text-gray-500'>Enable or disable this video</p>
                                        </div>
                                    </CardContent>
                                </Card>
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Youtube Video Settings</CardTitle>
                                        <p className="text-sm text-gray-500">
                                            Settings for the YouTube video.
                                        </p>
                                    </CardHeader>
                                    <CardContent className='space-y-2'>
                                        <div>
                                            <Label htmlFor="thumbnail" className="text-sm font-medium">
                                                Thumbnail
                                            </Label>
                                            <Input id="thumbnail" type="file" name="thumbnail" accept="image/*" onChange={(e) => setData('thumbnail', e.target.files ? e.target.files[0] : null)} />
                                            <InputError message={errors.thumbnail} className="mt-2" />
                                            <p className='text-sm text-gray-500'>Upload a thumbnail for the video</p>
                                            <p className='text-sm text-gray-500 mt-2'>If you don't upload a thumbnail, a default one will be used.</p>
                                        </div>
                                        {/* preview thumbnail */}
                                        {data.thumbnail && (
                                            <div className="mt-4">
                                                <p className="text-sm xtext-gray-500">Preview:</p>
                                                <img src={URL.createObjectURL(data.thumbnail)} alt="Thumbnail Preview" className="mt-2 w-full h-auto rounded-md" />
                                            </div>
                                        )}
                                        {
                                            !data.thumbnail && data.video_id && (
                                                <div className="mt-4">
                                                    <img src={`https://img.youtube.com/vi/${data.video_id}/0.jpg`} alt="Thumbnail Preview" className="mt-2 w-full h-auto rounded-md" />
                                                    <p className='text-sm text-gray-500 mt-2'>This is the default thumbnail from YouTube.</p>
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
};

export default Create;