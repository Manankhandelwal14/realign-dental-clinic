import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import React from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import Heading from '@/components/heading';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Callbacks',
        href: '/admin/callbacks',
    },
    {
        title: 'Create',
        href: '#',
    },
];

function Create() {
    const { data, setData, post, processing, errors } = useForm<{
        name: string;
        phone: string;
        datetime: string;
    }>({
        name: '',
        phone: '',
        datetime: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/callbacks');
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Callback" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title="Create Callback" description="Create a new callback request" className='mb-0' />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <Card>
                        <CardHeader>
                            <CardTitle>Callback Details</CardTitle>
                            <p className="mt-2 text-sm text-gray-500">
                                Basic information about the callback request.
                            </p>
                        </CardHeader>
                        <CardContent className='space-y-2'>
                            <div className="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                                <div>
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
                                <div>
                                    <Label htmlFor="phone" className="text-sm font-medium">
                                        Phone
                                    </Label>
                                    <Input
                                        id="phone"
                                        type="text"
                                        name="phone"
                                        value={data.phone}
                                        onChange={(e) => setData('phone', e.target.value)}
                                    />
                                    <InputError message={errors.phone} className="mt-2" />
                                </div>
                                <div>
                                    <Label htmlFor="time" className="text-sm font-medium">
                                        Date & Time
                                    </Label>
                                    <Input
                                        id="time"
                                        type="datetime-local"
                                        name="time"
                                        value={data.datetime}
                                        onChange={(e) => setData('datetime', e.target.value)}
                                    />
                                    <InputError message={errors.datetime} className="mt-2" />
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                    <div className="flex justify-end">
                        <Button type="submit" disabled={processing}>
                            {processing ? 'Creating...' : 'Create Callback'}
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}

export default Create;