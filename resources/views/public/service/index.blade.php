@extends('layouts.public.app')

@section('content')
    <section
        class="relative h-48 bg-cover bg-center bg-[url('https://media.realigndental.com/assets/images/about/about.jpg')]">
        <div class="absolute inset-0 bg-black/80"></div>
        <div class="container mx-auto px-6 h-full flex items-center relative">
            <div class="text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-6">Expert Dental Services</h1>
                <p class="text-xl">We offer a wide range of dental services to meet your needs.</p>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="font-montserrat font-bold text-3xl md:text-4xl mb-4 text-[teal]">Our Treatments</h2>
                <div class="h-1 w-24 bg-[teal] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">We offer comprehensive dental care for patients of all ages,
                    focusing on preventive care, cosmetic improvements, and restorative treatments.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <div class="bg-white rounded-md shadow-sm hover:shadow-lg transition-all overflow-hidden">
                        <img src="{{ $service->banner }}" alt="{{ $service->name }}" class="w-full object-contain">
                        <div class="p-6">
                            <h3 class="text-[1.1rem] font-semibold text-[teal] mb-3">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $service->sort_description }}</p>
                            <a href="{{ route('public.service.show', $service->slug) }}"
                                class="font-medium text-[teal] hover:text-[teal]/50 transition-all flex items-center">
                                Learn More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
