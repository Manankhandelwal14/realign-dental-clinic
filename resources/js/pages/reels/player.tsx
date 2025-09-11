import { Reel } from '@/types/reel';
import { Dialog, DialogContent } from '@/components/ui/dialog';
import { Progress } from '@/components/ui/progress';
import { Heart, Volume2, VolumeX, Play, Pause, Pencil } from 'lucide-react';
import React, { useRef, useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import SwiperCore from 'swiper';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/react';

interface ReelPlayerProps {
    reels: Reel[];
    initialReel: Reel;
    onClose: () => void;
}

const ReelPlayer: React.FC<ReelPlayerProps> = ({ reels, initialReel, onClose }) => {
    const [isPlaying, setIsPlaying] = useState<{ [key: string]: boolean }>(
        reels.reduce((acc, reel) => ({ ...acc, [reel.id]: reel.id === initialReel.id }), {})
    );
    const [isMuted, setIsMuted] = useState<{ [key: string]: boolean }>(
        reels.reduce((acc, reel) => ({ ...acc, [reel.id]: false }), {})
    );
    const [likes, setLikes] = useState<{ [key: string]: boolean }>(
        reels.reduce((acc, reel) => ({ ...acc, [reel.id]: false }), {})
    );
    const [progress, setProgress] = useState<{ [key: string]: number }>(
        reels.reduce((acc, reel) => ({ ...acc, [reel.id]: 0 }), {})
    );
    const videoRefs = useRef<{ [key: string]: HTMLVideoElement | null }>({});
    const swiperRef = useRef<SwiperCore | null>(null);

    // Ensure initial reel auto-plays on mount and when initialReel changes
    useEffect(() => {
        // Use a slight delay to ensure video refs are set
        const timer = setTimeout(() => {
            const initialVideo = videoRefs.current[initialReel.id];
            if (initialVideo) {
                setIsPlaying((prev) => ({ ...prev, [initialReel.id]: true }));
                initialVideo.play().catch((error) => {
                    console.error('Auto-play failed:', error);
                    setIsPlaying((prev) => ({ ...prev, [initialReel.id]: false }));
                });
            }
        }, 0);

        return () => clearTimeout(timer);
    }, [initialReel]);

    // Update progress for the current video
    useEffect(() => {
        const updateProgress = () => {
            Object.keys(videoRefs.current).forEach((reelId) => {
                const video = videoRefs.current[reelId];
                if (video && isPlaying[reelId]) {
                    const progressValue = (video.currentTime / video.duration) * 100;
                    setProgress((prev) => ({ ...prev, [reelId]: progressValue }));
                }
            });
        };

        const interval = setInterval(updateProgress, 100);
        return () => clearInterval(interval);
    }, [isPlaying]);

    const handleSlideChange = (swiper: SwiperCore) => {
        // Pause all videos and reset progress
        Object.keys(videoRefs.current).forEach((reelId) => {
            const video = videoRefs.current[reelId];
            if (video) {
                video.pause();
                setIsPlaying((prev) => ({ ...prev, [reelId]: false }));
                setProgress((prev) => ({ ...prev, [reelId]: 0 }));
            }
        });

        // Play the current video
        const currentReel = reels[swiper.activeIndex];
        const currentVideo = videoRefs.current[currentReel.id];
        if (currentVideo) {
            currentVideo.play().catch((error) => {
                console.error('Auto-play failed:', error);
                setIsPlaying((prev) => ({ ...prev, [currentReel.id]: false }));
            });
            setIsPlaying((prev) => ({ ...prev, [currentReel.id]: true }));
        }
    };

    const handleVideoEnded = (reelId: string) => {
        const currentIndex = reels.findIndex((reel) => reel.id === reelId);
        if (currentIndex < reels.length - 1 && swiperRef.current) {
            swiperRef.current.slideNext();
        }
    };

    const toggleLike = (reelId: string) => {
        setLikes((prev) => ({ ...prev, [reelId]: !prev[reelId] }));
    };

    const toggleMute = (reelId: string) => {
        const video = videoRefs.current[reelId];
        if (video) {
            video.muted = !video.muted;
            setIsMuted((prev) => ({ ...prev, [reelId]: !prev[reelId] }));
        }
    };

    const togglePlayPause = (reelId: string) => {
        const video = videoRefs.current[reelId];
        if (video) {
            if (isPlaying[reelId]) {
                video.pause();
                setIsPlaying((prev) => ({ ...prev, [reelId]: false }));
            } else {
                video.play().catch((error) => {
                    console.error('Play failed:', error);
                    setIsPlaying((prev) => ({ ...prev, [reelId]: false }));
                });
                setIsPlaying((prev) => ({ ...prev, [reelId]: true }));
            }
        }
    };

    return (
        <Dialog open={true} onOpenChange={onClose}>
            <DialogContent className="max-w-[90vh] p-0 w-fit">
                <div className="relative h-[90vh]">
                    <Swiper
                        direction="vertical"
                        className="h-full w-full"
                        initialSlide={reels.findIndex((reel) => reel.id === initialReel.id)}
                        onSlideChange={handleSlideChange}
                        spaceBetween={40}
                        onSwiper={(swiper) => {
                            swiperRef.current = swiper;
                        }}
                    >
                        {reels.map((reel) => (
                            <SwiperSlide key={reel.id}>
                                <div className="flex h-full w-full items-center justify-center relative rounded-lg overflow-hidden">
                                    <video
                                        ref={(el) => {
                                            videoRefs.current[reel.id] = el;
                                        }}
                                        className="h-full w-full object-contain rounded-lg overflow-hidden"
                                        src={reel.video}
                                        loop={false}
                                        muted={isMuted[reel.id]}
                                        onClick={() => togglePlayPause(reel.id)}
                                        onEnded={() => handleVideoEnded(reel.id)}
                                    />
                                    <div className="absolute bottom-4 left-4 right-4">
                                        <Progress value={progress[reel.id]} className="h-1" />
                                    </div>
                                    <div className="absolute bottom-12 right-4 flex flex-col gap-2">
                                        <Link href={route('admin.smile-snaps.edit', reel.id)}>
                                            <Button
                                                variant="default"
                                                size="icon"
                                                className="bg-white text-black rounded-full p-2"
                                            >
                                                <Pencil size={24} />
                                            </Button>
                                        </Link>
                                        <Button
                                            onClick={() => toggleLike(reel.id)}
                                            variant="default"
                                            size="icon"
                                            className="bg-white text-black rounded-full p-2"
                                        >
                                            <Heart
                                                size={24}
                                                className={likes[reel.id] ? 'fill-red-500 text-red-500' : ''}
                                            />
                                        </Button>
                                        <Button
                                            onClick={() => toggleMute(reel.id)}
                                            variant="default"
                                            size="icon"
                                            className="bg-white text-black rounded-full p-2"
                                        >
                                            {isMuted[reel.id] ? <VolumeX size={24} /> : <Volume2 size={24} />}
                                        </Button>
                                        <Button
                                            onClick={() => togglePlayPause(reel.id)}
                                            variant="default"
                                            size="icon"
                                            className="bg-white text-black rounded-full p-2"
                                        >
                                            {isPlaying[reel.id] ? <Pause size={24} /> : <Play size={24} />}
                                        </Button>
                                    </div>
                                </div>
                            </SwiperSlide>
                        ))}
                    </Swiper>
                </div>
            </DialogContent>
        </Dialog>
    );
};

export default ReelPlayer;