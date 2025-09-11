@extends('layouts.public.app')

@section('content')
    <section class="relative h-[40vh] bg-center bg-no-repeat bg-cover flex items-center"
        style="background-image: url('{{ $article->banner->url }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="text-white container px-5 md:px-16 relative">
            <h1 class="text-2xl md:text-5xl font-bold text-white mb-4">{{ $article->title }}</h1>
            <p class="text-lg mt-4 text-white">Experience expert dental care that brings <br />out the best in your
                smile—bright, confident, and beautifully aligned.</p>
        </div>
    </section>
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-8">
            <div class="md:col-span-8">
                <div class="rounded-t-lg overflow-hidden">{!! $article->content !!}</div>
            </div>
            <div class="md:col-span-4">
                <div class="bg-white border p-6 rounded-lg sticky top-32">
                    <!-- Search Bar -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" placeholder="Looking for..."
                                class="w-full rounded-full border-gray-300 shadow-sm pl-4 pr-12 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" />
                            <button class="absolute inset-y-0 right-3 flex items-center justify-center text-teal-500">

                            </button>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <h2 class="text-2xl font-bold text-teal-600 mb-4">Recent Posts</h2>
                    <div class="space-y-6">
                        <!-- Post Item -->
                        <div class="flex items-start space-x-4">
                            <img src="image1.jpg" alt="Post Thumbnail" class="w-16 h-16 rounded-md object-cover">
                            <div>
                                <p class="text-sm text-gray-500">December 18, 2019</p>
                                <a href="#" class="text-teal-600 font-medium hover:underline">
                                    The unexpected dangers of gum disease
                                </a>
                            </div>
                        </div>

                        <!-- Post Item -->
                        <div class="flex items-start space-x-4">
                            <img src="image2.jpg" alt="Post Thumbnail" class="w-16 h-16 rounded-md object-cover">
                            <div>
                                <p class="text-sm text-gray-500">December 12, 2019</p>
                                <a href="#" class="text-gray-800 font-medium hover:underline">
                                    What to know about tooth extraction
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
