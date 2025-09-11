import Heading from "@/components/heading";
import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { useState } from "react";
import { Dialog, DialogContent } from "@/components/ui/dialog";
import { DragDropContext, Droppable, Draggable, DropResult } from "@hello-pangea/dnd";
import { toast } from "sonner";
import { Badge } from "@/components/ui/badge";
import { Pencil, Trash } from "lucide-react";

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

interface VideosProps {
    videos: {
        data: YoutubeVideo[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        links: { url: string | null; label: string; active: boolean }[];
    };
    filters?: {
        search?: string;
        status?: string;
    };
}

const breadcrumbs = [
    { title: "Dashboard", href: "/admin/dashboard" },
    { title: "YouTube Videos", href: "#" },
];

const YoutubeVideos: React.FC<VideosProps> = ({ videos: initialVideos }) => {
    const [videos, setVideos] = useState<YoutubeVideo[]>(initialVideos.data);
    const [selectedVideo, setSelectedVideo] = useState<YoutubeVideo | null>(null);
    const [isModalOpen, setIsModalOpen] = useState(false);

    // Access flash messages

    // Initialize useForm for reorder request
    const { put, setData, reset } = useForm<{
        items: { id: string; order: number }[];
    }>({
        items: [],
    });

    const handleVideoClick = (video: YoutubeVideo) => {
        setSelectedVideo(video);
        setIsModalOpen(true);
    };

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

    const handleOnDragEnd = (result: DropResult) => {
        if (!result.destination) return;

        const reorderedVideos = Array.from(videos);
        const [movedVideo] = reorderedVideos.splice(result.source.index, 1);
        reorderedVideos.splice(result.destination.index, 0, movedVideo);

        setVideos(reorderedVideos);

        const items = reorderedVideos.map((video, index) => ({
            id: video.id,
            order: index + 1,
        }));

        // Submit reorder request
        setData("items", items);
        put(route("admin.youtube-videos.reorder"), {
            onSuccess: () => {
                reset();
                toast.success("Videos reordered successfully.");
            },
            onError: () => {
                setVideos(videos);
            },
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="YouTube Videos" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading
                        title="YouTube Videos"
                        description="Manage your YouTube videos."
                        className="mb-0"
                    />
                    <Button asChild>
                        <Link href={route("admin.youtube-videos.create")}>Add Video</Link>
                    </Button>
                </div>
                <DragDropContext onDragEnd={handleOnDragEnd}>
                    <Droppable droppableId="videos" direction="vertical">
                        {(provided) => (
                            <div
                                className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
                                {...provided.droppableProps}
                                ref={provided.innerRef}
                            >
                                {videos.map((video, index) => (
                                    <Draggable
                                        key={video.id}
                                        draggableId={video.id}
                                        index={index}
                                    >
                                        {(provided) => (
                                            <div
                                                ref={provided.innerRef}
                                                {...provided.draggableProps}
                                                {...provided.dragHandleProps}
                                                className="group relative cursor-pointer overflow-hidden rounded-xl bg-white shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100"
                                                onClick={() => handleVideoClick(video)}
                                            >
                                                <div className="relative">
                                                    <img
                                                        src={video.thumbnail || `https://img.youtube.com/vi/${video.video_id}/hqdefault.jpg`} alt={video.title}
                                                        className="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                                                        onError={(e) => {
                                                            (e.target as HTMLImageElement).src = `https://ui-avatars.com/api/?name=${video.title}`;
                                                        }}
                                                    />
                                                    {video.duration && (
                                                        <span className="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs font-medium px-2 py-1 rounded">
                                                            {video.duration}
                                                        </span>
                                                    )}
                                                    <div className="absolute inset-0 flex items-center justify-center bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                        <svg
                                                            className="w-16 h-16 text-white"
                                                            fill="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path d="M8 5v14l11-7z" />
                                                        </svg>
                                                    </div>
                                                    <Badge className={`absolute top-2 left-2 text-xs ${video.status ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800"}`}>
                                                        {video.status ? "Active" : "Inactive"}
                                                    </Badge>
                                                    {/* Drag handle */}
                                                    <div
                                                        className="absolute top-2 right-2 cursor-move"
                                                        {...provided.dragHandleProps}
                                                    >
                                                        <svg
                                                            className="w-5 h-5 text-gray-500"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                strokeLinecap="round"
                                                                strokeLinejoin="round"
                                                                strokeWidth="2"
                                                                d="M4 8h16M4 16h16"
                                                            />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div className="p-4">
                                                    <div className="min-h-20">
                                                        <h3 className="text-lg font-bold text-gray-900 truncate group-hover:text-blue-600 transition-colors">
                                                            {video.title}
                                                        </h3>
                                                        <p className="text-sm text-gray-500 mt-1 leading-relaxed line-clamp-2">
                                                            {video.description ||
                                                                "No description available"}
                                                        </p>
                                                    </div>
                                                    <div className="mt-3 flex items-center justify-between">
                                                        <span className="text-xs text-gray-400">
                                                            {video.published_at
                                                                ? new Date(
                                                                    video.published_at
                                                                ).toLocaleDateString()
                                                                : "N/A"}
                                                        </span>
                                                        <span className="text-xs text-gray-400">
                                                            #{video.order}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        )}
                                    </Draggable>
                                ))}
                                {provided.placeholder}
                            </div>
                        )}
                    </Droppable>
                </DragDropContext>
            </div>
            <Dialog open={isModalOpen} onOpenChange={setIsModalOpen}>
                <DialogContent className="max-w-4xl p-0 overflow-hidden">
                    {selectedVideo && (
                        <div className="flex flex-col">
                            <div className="relative aspect-video">
                                <iframe
                                    className="w-full h-full"
                                    src={`https://www.youtube.com/embed/${selectedVideo.video_id}?autoplay=1`}
                                    title={selectedVideo.title}
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowFullScreen
                                />
                                <Button
                                    className="absolute top-1.5 right-1.5 bg-white hover:bg-gray-50 cursor-pointer"
                                    onClick={() => setIsModalOpen(false)}
                                    size="icon"
                                >

                                </Button>
                            </div>
                            <div className="p-4">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <h2 className="text-xl font-bold">{selectedVideo.title}</h2>
                                        <p className="text-gray-600">
                                            {selectedVideo.description || "No description available"}
                                        </p>
                                    </div>
                                    <div>
                                        <span className="text-sm text-gray-500">
                                            Video {videos.findIndex((v) => v.id === selectedVideo.id) + 1} of {videos.length}
                                        </span>
                                    </div>
                                </div>
                                <div className="flex justify-between mt-4 border-t pt-4">
                                    <div className="flex items-center gap-3">
                                        <Button variant="destructive" size="icon"><Trash /></Button>
                                        <Link href={route('admin.youtube-videos.edit', selectedVideo.id)}><Button variant="outline" size="icon"><Pencil /></Button></Link>
                                    </div>
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
                </DialogContent>
            </Dialog>
        </AppLayout>
    );
};

export default YoutubeVideos;