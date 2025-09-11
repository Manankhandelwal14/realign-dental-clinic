import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/react';

interface YoutubeVideo {
    id: string;
    title: string;
    description: string | null;
    video_id: string;
    published_at: string | null;
    status: boolean;
}

interface ShowVideoProps {
    video: YoutubeVideo;
}

const breadcrumbs = [
    { title: 'Dashboard', href: '/admin/dashboard' },
    { title: 'YouTube Videos', href: '/admin/youtube-videos' },
    { title: 'View', href: '#' },
];

const Show: React.FC<ShowVideoProps> = ({ video }) => {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="View YouTube Video" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="YouTube Video Details" description="View details of the YouTube video" className="mb-0" />
                    <Button asChild>
                        <Link href={route('admin.youtube-videos.edit', video.id)}>Edit Video</Link>
                    </Button>
                </div>
                <Card>
                    <CardHeader>
                        <CardTitle>{video.title}</CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-4">
                        <div>
                            <h3 className="text-sm font-medium">Video ID</h3>
                            <p className="text-gray-500">{video.video_id}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium">Description</h3>
                            <p className="text-gray-500">{video.description || 'No description'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium">Published At</h3>
                            <p className="text-gray-500">{video.published_at ? new Date(video.published_at).toLocaleString() : 'Not specified'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium">Status</h3>
                            <p className="text-gray-500">{video.status ? 'Active' : 'Inactive'}</p>
                        </div>
                        <div>
                            <h3 className="text-sm font-medium">Preview</h3>
                            <iframe
                                width="560"
                                height="315"
                                src={`https://www.youtube.com/embed/${video.video_id}`}
                                title={video.title}
                                frameBorder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowFullScreen
                            ></iframe>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
};

export default Show;