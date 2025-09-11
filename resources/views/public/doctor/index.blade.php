@extends('layouts.public.app')
@section('content')
    <!-- Banner Section -->
    <section class="relative h-[40vh] bg-center bg-no-repeat bg-cover py-10 flex items-center"
        style="background-image: url('{{ asset('images/about/about.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
        <div class="container mx-auto px-6 h-full flex items-center relative">
            <div class="text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-6">Know Your Dentist</h1>
                <p class="text-xl">
                    We are here to help you find the best dentist for your needs. Our team of experienced
                    professionals is dedicated to providing you with the highest quality dental care.
                </p>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <div class="container px-5 md:px-16 py-12 w-full m-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[teal] mb-2">Know Your Dentist</h1>
            <p class="text-gray-600">Meet our team of expert dental care professionals</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($teams as $member)
                <div
                    class="bg-white rounded-lg shadow-sm hover:shadow-md overflow-hidden transition-all transform hover:-translate-y-2">
                    <img src="{{ $member->getFirstMediaUrl('image') }}" class="w-full object-cover"
                        alt="{{ $member->name }}" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-[teal]">
                            {{ $member->name }}
                        </h3>
                        <p class="text-gray-600 mb-4 text-xs">
                            {{ $member->designation }}
                        </p>
                        <div class="flex space-x-4 justify-between items-center">
                            @isset($member->social_media)
                                <div>
                                    @foreach ($member->social_media as $key => $value)
                                        <a href="{{ $value }}" class="text-gray-400 hover:text-primary">
                                            @if (Str::lower($key) === 'facebook')
                                                <x-icons.facebook class="w-6" />
                                            @endif
                                            @if (Str::lower($key) === 'twitter')
                                                <x-icons.twitter class="w-6" />
                                            @endif
                                            @if (Str::lower($key) === 'instagram')
                                                <x-icons.instagram class="w-6" />
                                            @endif
                                            @if (Str::lower($key) === 'linkedin')
                                                <x-icons.linkedin class="w-6" />
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endisset
                            <a href="{{ route('public.doctor.show', $member->slug) }}"
                                class="bg-[teal] text-white px-4 py-2 rounded-full text-xs font-semibold Z transition-all">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
