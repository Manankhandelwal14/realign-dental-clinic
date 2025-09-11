<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-3xl font-bold text-gray-700 mb-2 text-center">Hear from those who’ve smiled with us!
        </h2>
        <p class="text-lg text-gray-600 mb-8 text-center m-auto">
            See what our patients love about us – heartfelt stories that inspire confidence, trust, and the brightest
            smiles!
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 mt-10 gap-10">
            @foreach ($testimonials as $key => $testimonial)
                @if ($testimonial->type == 'testimonial')
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg video-card"
                        videoId="{{ $testimonial->id }}">
                        @if ($testimonial->getFirstMediaUrl('videos'))
                            <div class="rounded-t-lg overflow-hidden relative group">
                                {{-- auto play $key 1 --}}
                                <video loop muted class="w-full h-96 object-cover" id="video-{{ $testimonial->id }}"
                                    {{ $key == 1 ? 'autoplay' : '' }}>
                                    <source src="{{ $testimonial->getFirstMediaUrl('videos') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="absolute top-0 right-0 m-2 flex space-x-2"
                                    id="controls-{{ $testimonial->id }}">
                                    <button id="mute-btn-{{ $testimonial->id }}"
                                        class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-opacity-50"
                                        onclick="toggleMute('{{ $testimonial->id }}')">
                                        <x-icons.mute />
                                    </button>
                                </div>
                                <div
                                    class="absolute -bottom-1 group-hover:bottom-0 left-0 w-full h-1 bg-gray-800 border-t border-gray-800">
                                    <div id="progress-{{ $testimonial->id }}" class="h-full rounded-r-full bg-white"
                                        style="width: 0%;"></div>
                                </div>
                            </div>
                        @endif
                        <div class="p-3 border-t border-gray-800 dark:border-gray-700">
                            <p class="text-sm italic text-gray-800 dark:text-gray-100 capitalize">
                                {{ $testimonial->caption }}</p>
                            <h6 class="text-sm mt-1 font-semibold text-gray-800 dark:text-gray-100 capitalize">
                                - {{ $testimonial->name }}
                            </h6>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
    <script>
        function toggleMute(videoId) {
            const video = document.getElementById(`video-${videoId}`);
            const muteButton = document.getElementById(`mute-btn-${videoId}`);
            video.muted = !video.muted;
            muteButton.innerHTML = video.muted ? `<x-icons.mute />` : `<x-icons.unmute />`;
        }

        document.querySelectorAll('video').forEach(video => {
            const videoId = video.id.split('video-')[1];
            const progressBar = document.getElementById(`progress-${videoId}`);
            video.addEventListener('timeupdate', () => {
                const progress = (video.currentTime / video.duration) * 100;
                progressBar.style.width = `${progress}%`;
            });
            video.addEventListener('ended', () => {
                progressBar.style.width = '0%';
            });
        });

        document.querySelectorAll('.video-card').forEach(videoCard => {
            videoCard.addEventListener('mouseenter', () => {
                // video play
                const videoId = videoCard.getAttribute('videoId');
                const video = document.getElementById(`video-${videoId}`);
                video.play();
            });
            videoCard.addEventListener('mouseleave', () => {
                // video pause
                const videoId = videoCard.getAttribute('videoId');
                const video = document.getElementById(`video-${videoId}`);
                video.pause();
            });
        });
    </script>
@endpush
