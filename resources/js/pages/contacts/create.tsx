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
import Heading from '@/components/heading';
import { Facebook, Instagram, Linkedin, Mail, Phone, Trash, Twitter, Youtube } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Contacts',
        href: '/admin/contacts',
    },
    {
        title: 'Create',
        href: '#',
    },
];

function Create() {
    const { data, setData, post, processing, errors } = useForm<{
        website: string;
        phone: string;
        email: string;
        whatsapp: string;
        facebook: string;
        twitter: string;
        instagram: string;
        linkedin: string;
        youtube: string;
        street: string;
        city: string;
        state: string;
        zip: string;
        country: string;
        google_map_iframe: string;
        opening_hours: {
            day: string;
            slots: {
                opening: string;
                closing: string;
            }[];
        }[];
    }>({
        website: 'realigndental.com',
        phone: '+91 9123456789',
        email: 'info@realigndental.com',
        whatsapp: '+91 9123456789',
        facebook: 'https://facebook.com/realigndental',
        twitter: 'https://twitter.com/realigndental',
        instagram: 'https://instagram.com/realigndental',
        linkedin: 'https://linkedin.com/company/realigndental',
        youtube: 'https://youtube.com/realigndental',
        street: '123 Main St',
        city: 'Anytown',
        state: 'CA',
        zip: '12345',
        country: 'USA',
        google_map_iframe: '',
        opening_hours: [],
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.contacts.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Contact" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Heading title="Create Contact" description="Create a new contact entry" className="mb-0" />
                <form onSubmit={handleSubmit} className="space-y-3">
                    <div className="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div className="col-span-1 md:col-span-8 space-y-5">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Address</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">Physical address details.</p>
                                </CardHeader>
                                <CardContent className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <Label htmlFor="street" className="text-sm font-medium">
                                            Street
                                        </Label>
                                        <Input id="street" type="text" name="street" value={data.street} onChange={(e) => setData('street', e.target.value)} />
                                        <InputError message={errors.street} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="city" className="text-sm font-medium">
                                            City
                                        </Label>
                                        <Input id="city" type="text" name="city" value={data.city} onChange={(e) => setData('city', e.target.value)} />
                                        <InputError message={errors.city} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="state" className="text-sm font-medium">
                                            State
                                        </Label>
                                        <Input id="state" type="text" name="state" value={data.state} onChange={(e) => setData('state', e.target.value)} />
                                        <InputError message={errors.state} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="zip" className="text-sm font-medium">
                                            ZIP Code
                                        </Label>
                                        <Input id="zip" type="text" name="zip" value={data.zip} onChange={(e) => setData('zip', e.target.value)} />
                                        <InputError message={errors.zip} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="country" className="text-sm font-medium">
                                            Country
                                        </Label>
                                        <Input id="country" type="text" name="country" value={data.country} onChange={(e) => setData('country', e.target.value)} />
                                        <InputError message={errors.country} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="google_map_iframe" className="text-sm font-medium">
                                            Google Map Iframe
                                        </Label>
                                        <Textarea
                                            id="google_map_iframe"
                                            name="google_map_iframe"
                                            value={data.google_map_iframe}
                                            onChange={(e) => setData('google_map_iframe', e.target.value)}
                                            rows={5}
                                        />
                                        <InputError message={errors.google_map_iframe} className="mt-2" />
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader>
                                    <CardTitle>Opening Hours (JSON)</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">Opening hours in JSON format.</p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div>
                                        {data.opening_hours.map((dayItem, dayIndex) => (
                                            <div key={dayIndex} className="border p-3 rounded-md space-y-2">
                                                <div className="flex items-center gap-2">
                                                    <Input
                                                        type="text"
                                                        placeholder="Day (e.g., Monday)"
                                                        value={dayItem.day}
                                                        onChange={(e) => {
                                                            const updated = [...data.opening_hours];
                                                            updated[dayIndex].day = e.target.value;
                                                            setData('opening_hours', updated);
                                                        }}
                                                    />
                                                    <Button
                                                        variant="destructive"
                                                        size="sm"
                                                        onClick={() => {
                                                            const updated = data.opening_hours.filter((_, i) => i !== dayIndex);
                                                            setData('opening_hours', updated);
                                                        }}
                                                    >
                                                        <Trash className="h-4 w-4" />
                                                    </Button>
                                                </div>
                                                <h6 className="text-sm font-medium">Slots</h6>
                                                {dayItem.slots.map((slot, slotIndex) => (
                                                    <div key={slotIndex} className="flex gap-2">
                                                        <Input
                                                            type="time"
                                                            value={slot.opening}
                                                            onChange={(e) => {
                                                                const updated = [...data.opening_hours];
                                                                updated[dayIndex].slots[slotIndex].opening = e.target.value;
                                                                setData('opening_hours', updated);
                                                            }}
                                                        />
                                                        <Input
                                                            type="time"
                                                            value={slot.closing}
                                                            onChange={(e) => {
                                                                const updated = [...data.opening_hours];
                                                                updated[dayIndex].slots[slotIndex].closing = e.target.value;
                                                                setData('opening_hours', updated);
                                                            }}
                                                        />
                                                        <Button
                                                            variant="outline"
                                                            size="sm"
                                                            onClick={() => {
                                                                const updated = [...data.opening_hours];
                                                                updated[dayIndex].slots = updated[dayIndex].slots.filter(
                                                                    (_, i) => i !== slotIndex
                                                                );
                                                                setData('opening_hours', updated);
                                                            }}
                                                        >
                                                            <Trash className="h-4 w-4" />
                                                        </Button>
                                                    </div>
                                                ))}
                                                <Button
                                                    variant="secondary"
                                                    size="sm"
                                                    onClick={() => {
                                                        const updated = [...data.opening_hours];
                                                        updated[dayIndex].slots.push({ opening: '', closing: '' });
                                                        setData('opening_hours', updated);
                                                    }}
                                                >
                                                    Add Slot
                                                </Button>
                                            </div>
                                        ))}
                                        {errors.opening_hours && (
                                            <InputError message={errors.opening_hours} className="mt-2" />
                                        )}
                                        <Button
                                            variant="outline"
                                            type="button"
                                            onClick={() =>
                                                setData('opening_hours', [
                                                    ...data.opening_hours,
                                                    { day: '', slots: [{ opening: '', closing: '' }] },
                                                ])
                                            }
                                        >
                                            Add Day
                                        </Button>
                                    </div>
                                    <InputError message={errors.opening_hours} className="mt-2" />
                                </CardContent>
                            </Card>
                            <div className="flex justify-end">
                                <Button variant="secondary" className="mr-2" onClick={() => window.history.back()}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Creating...' : 'Create Contact'}
                                </Button>
                            </div>
                        </div>
                        <div className="col-span-1 md:col-span-4">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Social Media</CardTitle>
                                    <p className="mt-2 text-sm text-gray-500">
                                        Social media profiles.
                                    </p>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    <div>
                                        <Label htmlFor="facebook" className="text-sm font-medium">
                                            Facebook
                                        </Label>
                                        <div className="relative">
                                            <Input
                                                id="facebook"
                                                type="url"
                                                name="facebook"
                                                value={data.facebook}
                                                className='pl-10'
                                                placeholder='https://facebook.com/yourprofile'
                                                onChange={(e) => setData('facebook', e.target.value)}
                                            />
                                            <Facebook className="absolute left-2 top-1/2 transform -translate-y-1/2 text-blue-400" />
                                        </div>
                                        <InputError message={errors.facebook} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="twitter" className="text-sm font-medium">
                                            Twitter
                                        </Label>
                                        <div className="relative">
                                            <Input
                                                id="twitter"
                                                type="url"
                                                name="twitter"
                                                value={data.twitter}
                                                className='pl-10'
                                                placeholder='https://twitter.com/yourprofile'
                                                onChange={(e) => setData('twitter', e.target.value)}
                                            />
                                            <Twitter className="absolute left-2 top-1/2 transform -translate-y-1/2 text-blue-400" />
                                        </div>
                                        <InputError message={errors.twitter} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="instagram" className="text-sm font-medium">
                                            Instagram
                                        </Label>
                                        <div className="relative">
                                            <Input
                                                id="instagram"
                                                type="url"
                                                name="instagram"
                                                value={data.instagram}
                                                className='pl-10'
                                                placeholder='https://instagram.com/yourprofile'
                                                onChange={(e) => setData('instagram', e.target.value)}
                                            />
                                            <Instagram className="absolute left-2 top-1/2 transform -translate-y-1/2 text-red-400" />
                                        </div>
                                        <InputError message={errors.instagram} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="linkedin" className="text-sm font-medium">
                                            LinkedIn
                                        </Label>
                                        <div className="relative">
                                            <Input
                                                id="linkedin"
                                                type="url"
                                                name="linkedin"
                                                value={data.linkedin}
                                                className='pl-10'
                                                placeholder='https://linkedin.com/in/yourprofile'
                                                onChange={(e) => setData('linkedin', e.target.value)}
                                            />
                                            <Linkedin className="absolute left-2 top-1/2 transform -translate-y-1/2 text-blue-500" />
                                        </div>
                                        <InputError message={errors.linkedin} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="youtube" className="text-sm font-medium">
                                            YouTube
                                        </Label>
                                        <div className="relative">
                                            <Input
                                                id="youtube"
                                                type="url"
                                                name="youtube"
                                                value={data.youtube}
                                                className='pl-10'
                                                placeholder='https://youtube.com/yourchannel'
                                                onChange={(e) => setData('youtube', e.target.value)}
                                            />
                                            <Youtube className="absolute left-2 top-1/2 transform -translate-y-1/2 text-red-400" />
                                        </div>
                                        <InputError message={errors.youtube} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="website" className="text-sm font-medium">Website</Label>
                                        <div className="relative">
                                            <Input id="website" type="url" name="website" value={data.website} onChange={(e) => setData('website', e.target.value)}
                                                placeholder='https://yourwebsite.com'
                                                className='pl-13'
                                            />
                                            <span className="absolute left-2 top-1/2 transform -translate-y-1/2 text-yellow-400">www.</span>
                                        </div>
                                        <InputError message={errors.website} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="phone" className="text-sm font-medium">Phone</Label>
                                        <div className='relative'>
                                            <Input id="phone" type="tel" name="phone" value={data.phone} onChange={(e) => setData('phone', e.target.value)}
                                                placeholder='+91 9123456789'
                                                className='pl-10'
                                            />
                                            <Phone className="absolute left-2 top-1/2 transform -translate-y-1/2 text-green-400" />
                                        </div>
                                        <InputError message={errors.phone} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="email" className="text-sm font-medium">Email</Label>
                                        <div className='relative'>
                                            <Input id="email" type="email" name="email" value={data.email} onChange={(e) => setData('email', e.target.value)}
                                                placeholder='you@example.com'
                                                className='pl-10'
                                            />
                                            <Mail className="absolute left-2 top-1/2 transform -translate-y-1/2 text-blue-400" />
                                        </div>
                                        <InputError message={errors.email} className="mt-2" />
                                    </div>
                                    <div>
                                        <Label htmlFor="whatsapp" className="text-sm font-medium">WhatsApp</Label>
                                        <div className='relative'>
                                            <Input id="whatsapp" type="tel" name="whatsapp" value={data.whatsapp} onChange={(e) => setData('whatsapp', e.target.value)}
                                                placeholder='+91 9123456789'
                                                className='pl-10'
                                            />
                                            <Phone className="absolute left-2 top-1/2 transform -translate-y-1/2 text-green-400" />
                                        </div>
                                        <InputError message={errors.whatsapp} className="mt-2" />
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