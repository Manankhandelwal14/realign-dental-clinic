@extends('layouts.public.app')

@section('title', $team?->meta?->title ?? $team?->name)
@section('meta_description', $team?->meta?->description ?? $team?->sort_description)
@section('meta_keywords', implode(', ', $team?->meta?->keywords ?? []) ?? $team?->name)
@section('meta_og_title', $team?->meta?->title ?? $team?->name)
@section('meta_og_description', $team?->meta?->description ?? $team?->sort_description)
@section('meta_og_image', $team?->image)
@section('meta_twitter_title', $team?->meta?->title ?? $team?->name)
@section('meta_twitter_description', $team?->meta?->description ?? $team?->sort_description)
@section('meta_twitter_image', $team?->image)

@section('content')
    <section class="relative h-[40vh] bg-center bg-no-repeat bg-cover flex items-center"
        style="background-image: url('{{ asset('images/about/about.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="text-white container px-5 md:px-16 relative">
            <h1 class="text-2xl md:text-5xl font-bold text-white mb-4">{{ $team->name }}</h1>
            <p class="text-lg mt-4 text-white">
                {{ $team->sort_description }}
            </p>
        </div>
    </section>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="col-span-1 lg:col-span-4">
                <div class="sticky top-24">
                    @isset($team?->image)
                        <div class="relative">
                            <img src="{{ $team->image }}" alt="{{ $team->name }}" class="w-full h-auto rounded-lg mb-6">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 rounded-b-lg">
                                <h2 class="text-lg font-semibold text-white">{{ $team->name }}</h2>
                                <p class="text-sm text-gray-300">{{ $team->sort_description }}</p>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
            <div class="w-full col-span-1 lg:col-span-8">
                @isset($team?->content)
                    <div class="rounded-t-lg overflow-hidden prose mb-10">
                        {!! $team?->content?->html !!}
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
