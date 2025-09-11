@extends('layouts.public.app')

@section('title', $branch?->meta?->title ?? $branch?->name)
@section('meta_description', $branch?->meta?->description ?? $branch?->tagline)
@section('meta_keywords', implode(', ', $branch?->meta?->keywords ?? []) ?? $branch?->name)
@section('meta_og_title', $branch?->meta?->title ?? $branch?->name)
@section('meta_og_description', $branch?->meta?->description ?? $branch?->tagline)
@section('meta_og_image', asset('images/about/about.jpg'))
@section('meta_twitter_title', $branch?->meta?->title ?? $branch?->name)
@section('meta_twitter_description', $branch?->meta?->description ?? $branch?->tagline)
@section('meta_twitter_image', asset('images/about/about.jpg'))


@section('content')
    <section class="relative h-[40vh] bg-center bg-no-repeat bg-cover flex items-center"
        style="background-image: url('{{ asset('images/about/about.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="text-white container px-5 md:px-16 relative">
            <h1 class="text-2xl md:text-5xl font-bold text-white mb-4">{{ $branch->name }}</h1>
            <p class="text-lg mt-4 text-white">
                {{ $branch->tagline }}
            </p>
        </div>
    </section>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-3 gap-8">
            <div class="w-full col-span-3 lg:col-span-2">
                <h1 class="text-2xl font-bold mb-6 text-gray-900">Branch Details</h1>
                <div class="rounded-t-lg overflow-hidden prose mb-10 border shadow-md p-5 border-gray-200">
                    {!! $branch->content->html !!}
                </div>
            </div>
            <div class="w-full col-span-3 lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 mb-10 border border-gray-200 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4">Other Services</h2>
                    <ul class="space-y-4">
                        @foreach ($commonServices as $item)
                            <li
                                class="flex items-center space-x-2 border border-gray-200 p-3 rounded-lg hover:bg-gray-50 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                </svg>
                                <a href="{{ route('public.service.show', $item->slug) }}"
                                    class="text-gray-700 hover:text-teal-500 transition duration-300 text-sm truncate">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
