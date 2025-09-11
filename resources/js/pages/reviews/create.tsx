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
import { Review, ReviewFormRequest } from '@/types/review';
import { Loader } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Reviews',
        href: '/admin/reviews',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateReviewProps {
    services: Service[];
    users: User[];
    review?: Review;
}

function Create({ services, users, review }: CreateReviewProps) {
    const { data, setData, post, processing, errors } = useForm<ReviewFormRequest>({
        author: review?.author || '',
        content: review?.content || '',
        rating: review?.rating || 1,
        status: review?.status || true,
        featured: review?.featured || false,
        service_id: review?.service_id || null,
        user_id: review?.user_id || null,
        date: review?.date || null,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        if (review) {
            router.post(route('admin.reviews.update', review.id), {
                ...data,
                _method: 'PUT',
            });
            return;
        }
        post(route('admin.reviews.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={review ? "Edit Review" : "Create Review"} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title={review ? "Edit Review" : "Create Review"} description={review ? "Edit the review" : "Create a new review"} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Review Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the review.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div>
                                        <Label htmlFor="author" className="text-sm font-medium">
                                            Author
                                        </Label>
                                        <Input
                                            id="author"
                                            type="text"
                                            name="author"
                                            value={data.author}
                                            onChange={(e) => setData('author', e.target.value)}
                                        />
                                        <InputError message={errors.author} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="content" className="text-sm font-medium">
                                            Content
                                        </Label>
                                        <Textarea
                                            id="content"
                                            name="content"
                                            value={data.content}
                                            onChange={(e) => setData('content', e.target.value)}
                                            rows={5}
                                        />
                                        <InputError message={errors.content} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="rating" className="text-sm font-medium">
                                            Rating (1-5)
                                        </Label>
                                        <Input
                                            id="rating"
                                            type="number"
                                            name="rating"
                                            min="1"
                                            max="5"
                                            value={data.rating}
                                            onChange={(e) => setData('rating', parseInt(e.target.value))}
                                        />
                                        <InputError message={errors.rating} className="mt-2" />
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
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader>
                                    <CardTitle>Review Relations</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Associate the review with a service or user.
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
                                    {processing ? <Loader /> : review ? "Update Review" : "Create Review"}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <Card className="sticky top-4">
                                <CardHeader>
                                    <CardTitle>Review Settings</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        These settings affect the status of the review.
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
                                        <p className="text-sm text-gray-500">Enable or disable this review</p>
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
                                        <p className="text-sm text-gray-500">Show this review on the homepage</p>
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