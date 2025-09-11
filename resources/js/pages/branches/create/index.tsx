import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/react';
import React from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import Heading from '@/components/heading';
import type { Branch, BranchFormRequest } from '@/types/branch';
import { toast } from 'sonner';
import AddressDetails from './address-details';
import BasicInfo from './branch-info';
import OpeningHours from './opening-hours';
import ContactDetails from './contact-details';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Branches',
        href: '/admin/branches',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateBranchProps {
    branch?: Branch
}

const Create: React.FC<CreateBranchProps> = ({ branch }) => {

    const { data, setData, post, processing, errors } = useForm<BranchFormRequest>({
        name: branch?.name ?? '',
        tagline: branch?.tagline ?? '',
        address: branch?.address ?? '',
        district: branch?.district ?? '',
        city: branch?.city ?? '',
        state: branch?.state ?? '',
        map_iframe: branch?.map_iframe ?? '',
        opening_hours: branch?.opening_hours ?? [],
        phone: branch?.phone ?? '',
        email: branch?.email ?? '',
        website: branch?.website ?? '',
        status: branch?.status ?? false,
        featured: branch?.featured ?? false,
        banner: null,
    });

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0] ?? null;
        setData('banner', file);
    }

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        if (branch) {
            router.post(route('admin.branches.update', branch.id), {
                _method: 'put',
                ...data
            });
            return;
        }
        post(route('admin.branches.store'), {
            onError: (errors) => {
                toast.error('Error creating branch');
                console.log(errors);
            }
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={branch ? 'Update Branch' : 'Create Branch'} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title={branch ? 'Update Branch' : 'Create Branch'} description="Create a new branch" className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <BasicInfo data={data} setData={setData} errors={errors} />
                            <AddressDetails data={data} setData={setData} errors={errors} />
                            <OpeningHours data={data} setData={setData} errors={errors} />
                            {/* Branch Contact Details */}
                            <ContactDetails data={data} setData={setData} errors={errors} />
                            {/* branch */}
                            <div className="flex justify-end gap-3">
                                <Button asChild variant="outline"><Link href={route('admin.branches.index')}>Cancel</Link></Button>
                                <Button type="submit">{processing ? (branch ? 'Updating' : 'Creating') : (branch ? 'Update Branch' : 'Create Branch')}</Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <div className="sticky top-4 space-y-4">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Branch Settings</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            These settings affect the status of the branch.
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
                                            <p className="text-sm text-gray-500">Enable or disable this branch</p>
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
                                            <p className="text-sm text-gray-500">Show this branch on the homepage</p>
                                        </div>
                                    </CardContent>
                                </Card>
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Banner</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            Upload a banner image for this branch.
                                        </p>
                                    </CardHeader>
                                    <CardContent className="space-y-5">
                                        <div className="flex items-center space-x-2">
                                            <Input
                                                id="banner"
                                                type="file"
                                                accept="image/*"
                                                onChange={handleFileChange}
                                            />
                                        </div>
                                        <InputError message={errors.banner} className="mt-2" />
                                        {/* preview banner  */}
                                        {data.banner && (
                                            <img
                                                src={URL.createObjectURL(data.banner)}
                                                alt="Banner Preview"
                                                className="mt-2 h-32 w-full object-cover rounded-md"
                                            />
                                        )}
                                        {!data.banner && branch?.banner && (
                                            <img src={branch?.banner} alt="Banner Preview" className="mt-2 h-32 w-full object-cover rounded-md" />
                                        )}
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