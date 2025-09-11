import AppLayout from '@/layouts/app-layout'
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react'
import React from 'react'
import { Service } from '@/types/service';
import Editor from '@/lib/editor/Editor';
import { FileText, Save } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { toast } from 'sonner';

interface BranchContentProps {
    service: Service;
}


const Content: React.FC<BranchContentProps> = ({ service }) => {


    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/admindashboard',
        },
        {
            title: 'Services',
            href: '/admin/services',
        },
        {
            title: service.name,
            href: '#',
        },
    ];

    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    const { data, setData, post } = useForm({
        json: service?.content?.content || {},
        html: service?.content?.html || '',
    });

    const handleSave = () => {
        post(route('admin.services.content.editor.save', service.id), {
            onSuccess: () => {
                toast.success('Service content saved successfully!');
            },
            onError: (errors) => {
                toast.error('Failed to save content!');
                console.error(errors);
            },
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Branch" />
            <div className="px-10 py-4 flex items-center justify-between border-b sticky top-0 z-10 bg-background">
                <div className="editor-title">
                    <FileText size={20} /><h1>{service.name}</h1>
                </div>
                <div className="editor-status">
                    <a href={route('public.service.show', service.slug)} target="_blank" className="btn btn-primary">
                        <Button variant="outline">Preview</Button>
                    </a>
                    <Button
                        onClick={handleSave}
                    >
                        <Save size={16} />
                        Save
                    </Button>
                </div>
            </div>
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Editor
                    data={service?.content?.content}
                    onChange={setData}
                    editorblock="editorjs-container"
                />
            </div>
        </AppLayout>
    )
}

export default Content