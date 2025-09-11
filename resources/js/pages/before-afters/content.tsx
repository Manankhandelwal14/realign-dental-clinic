// import Editor from '@/lib/editor/Editor';
// import AppLayout from '@/layouts/app-layout'
// import { BreadcrumbItem } from '@/types';
// import { Head, useForm } from '@inertiajs/react'
// import React from 'react'
// import edjsHTML from 'editorjs-html';
// import { toast } from 'sonner';
// import { BeforeAfter } from '@/types/before-after';


// interface BranchContentProps {
//     beforeAfter: BeforeAfter;
// }

// const edjsParser = edjsHTML();

// const Content: React.FC<BranchContentProps> = ({ beforeAfter }) => {

//     const breadcrumbs: BreadcrumbItem[] = [
//         {
//             title: 'Dashboard',
//             href: '/dashboard',
//         },
//         {
//             title: 'Before & Afters',
//             href: '/before-afters',
//         },
//         {
//             title: 'Create',
//             href: '#',
//         },
//     ];

//     const { data, setData, post } = useForm({
//         content: beforeAfter?.content?.content,
//         html: beforeAfter?.content?.html,
//     });

//     const handleSave = () => {
//         post(route('before-afters.content.editor.save', beforeAfter.id), {
//             onSuccess: () => {
//                 toast.success('Content saved successfully!');
//                 localStorage.removeItem('editorData');
//             },
//             onError: (errors) => {
//                 toast.error('Failed to save content!');
//                 console.error(errors);
//             },
//         });
//     };

//     return (
//         <AppLayout breadcrumbs={breadcrumbs}>
//             <Head title="Create Branch" />
//             <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
//                 <EditorComponent title="Branch Content" onSave={handleSave} setData={(content) => setData({
//                     content: content,
//                     html: edjsParser.parse(JSON.parse(content)),
//                 })} content={data.content} />
//             </div>
//         </AppLayout>
//     )
// }

// export default Content

import React from 'react'

const content = () => {
    return (
        <div>content</div>
    )
}

export default content