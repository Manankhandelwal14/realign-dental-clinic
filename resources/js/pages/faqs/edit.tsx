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
import { Faq } from '@/types/faq';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'FAQs',
        href: '/admin/faqs',
    },
    {
        title: 'Edit',
        href: '#',
    },
];

interface EditFaqProps {
    faq: Faq;
}

function Edit({ faq }: EditFaqProps) {
    const { data, setData, put, processing, errors } = useForm<{
        question: string;
        answer: string;
        status: boolean;
        featured: boolean;
    }>({
        question: faq.question || '',
        answer: faq.answer || '',
        status: faq.status || false,
        featured: faq.featured || false,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.faqs.update', faq.id));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit FAQ" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title="Edit FAQ" description={`Edit FAQ - ${faq.question}`} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>FAQ Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the FAQ.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div>
                                        <Label htmlFor="question" className="text-sm font-medium">
                                            Question
                                        </Label>
                                        <Input
                                            id="question"
                                            type="text"
                                            name="question"
                                            value={data.question}
                                            onChange={(e) => setData('question', e.target.value)}
                                        />
                                        <InputError message={errors.question} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="answer" className="text-sm font-medium">
                                            Answer
                                        </Label>
                                        <Textarea
                                            id="answer"
                                            name="answer"
                                            value={data.answer}
                                            onChange={(e) => setData('answer', e.target.value)}
                                            rows={5}
                                        />
                                        <InputError message={errors.answer} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Updating...' : 'Update FAQ'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <Card className="sticky top-4">
                                <CardHeader>
                                    <CardTitle>FAQ Settings</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        These settings affect the status of the FAQ.
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
                                        <p className="text-sm text-gray-500">Enable or disable this FAQ</p>
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
                                        <p className="text-sm text-gray-500">Show this FAQ on the homepage</p>
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