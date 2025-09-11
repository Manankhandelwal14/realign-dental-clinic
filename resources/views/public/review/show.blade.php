@extends('layouts.public.app')

@section('title', $review->name . ' - Patient Review')
@section('meta_title', $review->name . ' - Review on Our Treatments')
@section('meta_description', Str::limit($review->caption, 150))
@section('meta_keywords', 'patient review, dental review, user feedback, clinic experience')
@section('meta_og_title', $review->name . ' - Review on Our Treatments')
@section('meta_og_description', Str::limit($review->caption, 150))
@section('meta_twitter_title', $review->name . ' - Review on Our Treatments')
@section('meta_twitter_description', Str::limit($review->caption, 150))


@section('content')
    <section class="relative h-[300px] bg-cover bg-center"
        style="background-image: url('https://public.readdy.ai/ai/img_res/645e7f0013435a5a5381f54b17605bca.jpg')">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="container mx-auto px-4 h-full flex items-center relative">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold mb-6">Patient Review</h1>
                <p class="text-xl mb-8">Read the full experience shared by our valued patient.</p>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div
                class="max-w-6xl mx-auto bg-white p-6 shadow rounded-lg hover:transform hover:scale-105 transition-transform">
                <div class="flex mb-4 justify-between">
                    <div class="flex items-center">
                        <div class="rounded-full overflow-hidden w-9 h-9">
                            @if ($review->image)
                                <img src="{{ $review->image }}" class="rounded-full mr-4" alt="{{ $review->author }}" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $review?->author }}&color=7F9CF5&background=EBF4FF"
                                    alt="{{ $review?->author }}" class="w-full h-full object-cover" loading="lazy">
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ $review->author }}</h3>
                            <p class="text-sm text-gray-500"> {{ $review?->date?->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="text-xl {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        @endfor
                    </div>
                </div>
                <p class="text-gray-700 mt-4">{{ $review->content }}</p>
                <div class="mt-8">
                    <a href="{{ route('public.reviews') }}" class="text-[teal] font-semibold hover:underline">← Back to
                        Reviews</a>
                </div>
            </div>
            <div class="max-w-6xl mx-auto mt-8">

                <div class="grid md:grid-cols-4 gap-8">
                    @foreach ($reviews as $reviewis)
                        @if ($reviewis->id == $review->id)
                            @continue
                        @endif

                        <div
                            class="bg-white p-6 rounded-lg shadow-sm hover:transform hover:scale-105 transition-transform cursor-pointer">
                            <div class="flex items-center mb-4 gap-1">
                                @for ($i = 0; $i < $reviewis->rating; $i++)
                                    <x-icons.star class="text-yellow-500 h-5 w-5" />
                                @endfor
                            </div>
                            <div class="mb-3">
                                <p class="text-gray-600 italic line-clamp-5">"{{ $reviewis->content }}"</p>
                                <a href="{{ route('public.review.show', $reviewis) }}"
                                    class="text-[teal] hover:text-[teal]/80 text-sm">Read
                                    More ...</a>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="rounded-full overflow-hidden w-9 h-9">
                                    @if ($reviewis->image)
                                        <img src="{{ $reviewis->image }}" class="rounded-full mr-4"
                                            alt="{{ $reviewis->author }}" />
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ $v?->author }}&color=7F9CF5&background=EBF4FF"
                                            alt="{{ $reviewis?->author }}" class="w-full h-full object-cover"
                                            loading="lazy">
                                    @endif
                                </div>
                                <div>
                                    <h6 class="font-semibold text-sm">{{ $reviewis->author }}</h6>
                                    <p class="text-xs text-gray-500">
                                        {{ $reviewis->date->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
