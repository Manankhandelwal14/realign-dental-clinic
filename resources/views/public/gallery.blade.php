@extends('layouts.public.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-[teal] mb-2">Our Gallery</h1>
            <p>Explore our dental clinic's photo gallery showcasing our state-of-the-art facilities, modern equipment, patient care experience, and team in action. We’re committed to providing a clean, safe, and welcoming environment for every smile.</p>
        </div>
        {{-- Gallery Images --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            @foreach ($gallery as $image)
                <div class="faq-item bg-white border rounded-lg shadow-sm overflow-hidden">
                    <img src="{{ $image->image }}" 
                         alt="Gallery Image" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300" />
                </div>
            @endforeach
        </div>
    </div>
@endsection