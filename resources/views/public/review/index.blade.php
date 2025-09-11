@extends('layouts.public.app')

@section('title', 'Patient Reviews - Realign Dental Clinic Jaipur')
@section('meta_description', 'Read genuine reviews from our happy patients who have experienced exceptional dental care at Realign Dental Clinic Jaipur.')
@section('meta_keywords', 'patient reviews, dental care, Realign Dental Clinic, Jaipur')
@section('meta_og_title', 'Patient Reviews - Realign Dental Clinic Jaipur')
@section('meta_og_description', 'Read genuine reviews from our happy patients who have experienced exceptional dental care at Realign Dental Clinic Jaipur.')
@section('meta_twitter_title', 'Patient Reviews - Realign Dental Clinic Jaipur')
@section('meta_twitter_description', 'Read genuine reviews from our happy patients who have experienced exceptional dental care at Realign Dental Clinic Jaipur.')

@section('content')
    <section class="relative h-[300px] bg-cover bg-center"
        style="background-image: url('https://public.readdy.ai/ai/img_res/645e7f0013435a5a5381f54b17605bca.jpg')">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="container mx-auto px-4 h-full flex items-center relative">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold mb-6">What Our Patients Say</h1>
                <p class="text-xl mb-8">Read genuine reviews from our happy patients who have experienced exceptional dental
                    care.</p>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-[teal] mb-4">Our Patients, Our Pride</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Authentic stories of care, trust, and transformation. Join
                    the
                    family of happy, healthy smiles today!</p>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                @foreach ($reviews as $review)
                    <div
                        class="bg-white p-6 rounded-lg shadow-sm hover:transform hover:scale-105 transition-transform cursor-pointer">
                        <a href="{{ route('public.review.show', $review) }}">
                            <div class="flex items-center mb-4 gap-1">
                                @for ($i = 0; $i < $review?->rating; $i++)
                                    <x-icons.star class="text-yellow-500 h-5 w-5" />
                                @endfor
                            </div>
                            <div class="mb-3">
                                <p class="text-gray-600 italic line-clamp-5">"{{ $review?->content }}"</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="rounded-full overflow-hidden w-9 h-9">
                                    @if ($review->image)
                                        <img src="{{ $review->image }}" class="rounded-full mr-4"
                                            alt="{{ $review->author }}" />
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ $review?->author }}&color=7F9CF5&background=EBF4FF"
                                            alt="{{ $review?->author }}" class="w-full h-full object-cover" loading="lazy">
                                    @endif
                                </div>
                                <div>
                                    <h6 class="font-semibold text-sm">{{ $review->author }}</h6>
                                    <p class="text-xs text-gray-500">
                                        {{ $review->date->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $reviews->links() }} {{-- Pagination --}}
            </div>
    </section>
@endsection
