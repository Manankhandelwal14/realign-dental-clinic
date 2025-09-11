import AppLayout from '@/layouts/app-layout'
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react'
import React from 'react'
import Editor from '@/lib/editor/Editor';
import { FileText, Save } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Team } from '@/types/team';

interface BranchContentProps {
    team: Team;
}


const Content: React.FC<BranchContentProps> = ({ team }) => {

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
            title: team.name,
            href: '#',
        },
    ];

    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    const { data, setData, post } = useForm({
        json: team?.content?.content || {},
        html: team?.content?.html || '',
    });

    const handleSave = () => {
        post(route('admin.teams.content.editor.save', team.id));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Branch" />
            <div className="px-10 py-4 flex items-center justify-between border-b sticky top-0 bg-background z-10">
                <div className="editor-title">
                    <FileText size={20} /><h1>{team.name}</h1>
                </div>
                <div className="editor-status">
                    {/* <a href={route('public.team.show', team.slug)} target="_blank" className="btn btn-primary">
                        <Button variant="outline">Preview</Button>
                    </a> */}
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
                    data={team?.content?.content}
                    onChange={setData}
                    editorblock="editorjs-container"
                />
            </div>
        </AppLayout>
    )
}

export default Content