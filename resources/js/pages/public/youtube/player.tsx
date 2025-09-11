import { Button } from '@/components/ui/button'
import { X } from 'lucide-react';
import React from 'react'

interface YoutubeVideo {
    id: string;
    title: string;
    description: string | null;
    video_id: string;
    published_at: string | null;
    status: boolean;
    order: number;
    thumbnail: string | null;
    duration?: string;
}

interface PlayerProps {
    videos: YoutubeVideo[];
    initialVideo: YoutubeVideo | null;
}

const Player = ({ videos, initialVideo }: PlayerProps) => {

    const [selectedVideo, setSelectedVideo] = React.useState<YoutubeVideo | null>(initialVideo);

    const handleNextVideo = () => {
        if (!selectedVideo) return;
        const currentIndex = videos.findIndex((v) => v.id === selectedVideo.id);
        const nextIndex = (currentIndex + 1) % videos.length;
        setSelectedVideo(videos[nextIndex]);
    };

    const handlePrevVideo = () => {
        if (!selectedVideo) return;
        const currentIndex = videos.findIndex((v) => v.id === selectedVideo.id);
        const prevIndex = (currentIndex - 1 + videos.length) % videos.length;
        setSelectedVideo(videos[prevIndex]);
    };

    return (
        <div className='flex justify-center md:items-center h-screen bg-black'>
            <div className="max-w-5xl">
                {selectedVideo && (
                    <div className="flex flex-col">
                        <div className="relative aspect-video border rounded-lg overflow-hidden">
                            <iframe
                                className="w-full h-full"
                                src={`https://www.youtube.com/embed/${selectedVideo.video_id}?autoplay=1`}
                                title={selectedVideo.title}
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowFullScreen
                            />
                        </div>
                        <div className="p-4">
                            <div className="flex items-center justify-between">
                                <div>
                                    <h2 className="text-xl font-bold text-white">{selectedVideo.title}</h2>
                                    <p className="text-gray-200">
                                        {selectedVideo.description || "No description available"}
                                    </p>
                                </div>
                            </div>
                            <div className="flex justify-between mt-4 border-t pt-4">
                                <div className="flex items-center gap-3">
                                    <Button
                                        variant="outline"
                                        onClick={handlePrevVideo}
                                        disabled={videos.length <= 1}
                                    >
                                        Previous
                                    </Button>
                                    <Button
                                        variant="outline"
                                        onClick={handleNextVideo}
                                        disabled={videos.length <= 1}
                                    >
                                        Next
                                    </Button>
                                </div>
                            </div>
                        </div>
                    </div>
                )}
            </div>
            <a href="/" className="absolute top-5 right-10 bg-white hover:bg-gray-50 cursor-pointer p-3 rounded-full shadow-md transition-all duration-200">
                <X className="h-4 w-4 text-gray-500" />
            </a>
        </div>
    )
}

export default Player;