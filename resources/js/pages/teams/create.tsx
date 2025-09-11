import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/react';
import React, { useState } from 'react';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Switch } from '@/components/ui/switch';
import Heading from '@/components/heading';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Branch } from '@/types/branch';
import { Team, TeamRequestForm } from '@/types/team';
import { Loader } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Teams',
        href: '/admin/teams',
    },
    {
        title: 'Create',
        href: '#',
    },
];

interface CreateTeamProps {
    branches: Branch[];
    team: Team;
}

interface SocialMedia {
    platform: string;
    url: string;
}

function Create({ branches, team }: CreateTeamProps) {
    const { data, setData, post, processing, errors } = useForm<TeamRequestForm>({
        name: team?.name || '',
        designation: team?.designation || '',
        sort_description: team?.sort_description || '',
        status: team?.status || false,
        featured: team?.featured || false,
        branch_id: team?.branch_id || null,
        image: null as File | null,
        social_media: team?.social_media || [],
    });

    const [socialMediaInput, setSocialMediaInput] = useState<SocialMedia>({ platform: '', url: '' });

    const addSocialMedia = () => {
        if (socialMediaInput.platform && socialMediaInput.url) {
            setData('social_media', [...data.social_media, socialMediaInput]);
            setSocialMediaInput({ platform: '', url: '' });
        } else {
            alert('Please fill in both platform and URL.');
        }
    };

    const removeSocialMedia = (index: number) => {
        setData('social_media', data.social_media.filter((_, i) => i !== index));
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (team) {
            router.post(route('admin.teams.update', team.id), {
                ...data,
                _method: 'PUT',
            });
            return;
        }

        post(route('admin.teams.store'), {
            forceFormData: true,
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={team ? `Edit Team Member: ${team.name}` : 'Create Team Member'} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title={team ? `Edit Team Member - ${team.name}` : 'Create Team Member'} description={team ? `Edit the details of ${team.name}` : 'Create a new team member'} className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Team Member Info</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Basic information about the team member.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                            <Label htmlFor="designation" className="text-sm font-medium">
                                                Designation
                                            </Label>
                                            <Input
                                                id="designation"
                                                name="designation"
                                                value={data.designation}
                                                onChange={(e) => setData('designation', e.target.value)}
                                            />
                                            <InputError message={errors.designation} className="mt-2" />
                                        </div>
                                    </div>
                                    <div>
                                        <Label htmlFor="sort_description" className="text-sm font-medium">
                                            Short Description
                                        </Label>
                                        <Textarea
                                            id="sort_description"
                                            name="sort_description"
                                            value={data.sort_description}
                                            onChange={(e) => setData('sort_description', e.target.value)}
                                            rows={3}
                                        />
                                        <InputError message={errors.sort_description} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader>
                                    <CardTitle>Team Member Relations</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Associate the team member with a branch.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div>
                                        <Label htmlFor="branch_id" className="text-sm font-medium">
                                            Branch
                                        </Label>
                                        <Select
                                            onValueChange={(value) => setData('branch_id', value === 'none' ? null : value)}
                                            value={data.branch_id || 'none'}
                                        >
                                            <SelectTrigger>
                                                <SelectValue placeholder="Select a branch" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem value="none">None</SelectItem>
                                                {branches.map((branch) => (
                                                    <SelectItem key={branch.id} value={branch.id}>
                                                        {branch.name}
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        <InputError message={errors.branch_id} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader>
                                    <CardTitle>Social Media</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Add social media links for the team member.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <Label htmlFor="platform" className="text-sm font-medium">
                                                Platform
                                            </Label>
                                            <Input
                                                id="platform"
                                                value={socialMediaInput.platform}
                                                onChange={(e) => setSocialMediaInput({ ...socialMediaInput, platform: e.target.value })}
                                                placeholder="e.g., LinkedIn"
                                            />
                                        </div>
                                        <div>
                                            <Label htmlFor="url" className="text-sm font-medium">
                                                URL
                                            </Label>
                                            <Input
                                                id="url"
                                                value={socialMediaInput.url}
                                                onChange={(e) => setSocialMediaInput({ ...socialMediaInput, url: e.target.value })}
                                                placeholder="e.g., https://linkedin.com/in/username"
                                            />
                                        </div>
                                        <div className="flex items-end">
                                            <Button type="button" onClick={addSocialMedia}>
                                                Add
                                            </Button>
                                        </div>
                                    </div>
                                    {data.social_media.length > 0 && (
                                        <div className="mt-4">
                                            <h4 className="text-sm font-medium">Added Social Media</h4>
                                            {data.social_media.map((social, index) => (
                                                <div key={index} className="flex justify-between items-center mt-2">
                                                    <span>{social.platform}: {social.url}</span>
                                                    <Button
                                                        type="button"
                                                        variant="destructive"
                                                        size="sm"
                                                        onClick={() => removeSocialMedia(index)}
                                                    >
                                                        Remove
                                                    </Button>
                                                </div>
                                            ))}
                                        </div>
                                    )}
                                    <InputError message={errors.social_media} className="mt-2" />
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? <Loader /> : team ? 'Update Team Member' : 'Create Team Member'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <div className="sticky top-4">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Team Member Settings</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            These settings affect the status of the team member.
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
                                            <p className="text-sm text-gray-500">Enable or disable this team member</p>
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
                                            <p className="text-sm text-gray-500">Show this team member on the homepage</p>
                                        </div>
                                    </CardContent>
                                </Card>
                                <Card className="mt-4">
                                    <CardHeader>
                                        <CardTitle>Image</CardTitle>
                                        <p className="mt-2 text-sm text-gray-500">
                                            Upload an image for this team member.
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
                                            !data.image && team?.image && (
                                                <div className="mt-2">
                                                    <img
                                                        src={team.image}
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