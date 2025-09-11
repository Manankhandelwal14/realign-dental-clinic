@extends('layouts.public.app')

@section('title', $service?->meta?->title ?? $service?->name)
@section('meta_description', $service?->meta?->description ?? $service?->sort_description)
@section('meta_keywords', implode(', ', $service?->meta?->keywords ?? []) ?? $service?->name)
@section('meta_og_title', $service?->meta?->title ?? $service?->name)
@section('meta_og_description', $service?->meta?->description ?? $service?->sort_description)
@section('meta_og_image', $service?->banner)
@section('meta_twitter_title', $service?->meta?->title ?? $service?->name)
@section('meta_twitter_description', $service?->meta?->description ?? $service?->sort_description)
@section('meta_twitter_image', $service?->banner)

@section('schema.org')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Dentist",
      "name": "Realign Dental Clinic Jaipur",
      "image": "{{ $service->banner }}",
      "url": "{{ url()->current() }}",
      "telephone": "+91-7891012206",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Shop No 94/40, Mansarovar",
        "addressLocality": "Jaipur",
        "addressRegion": "Rajasthan",
        "postalCode": "302020",
        "addressCountry": "IN"
      },
      "openingHours": "Mo-Sa 10:00-18:00",
      "currenciesAccepted": "INR",
      "priceRange": "₹₹",
      "sameAs": [
        "https://www.instagram.com/realigndentalclinic",
      ],
      "makesOffer": {
        "@type": "Offer",
        "url": "{{ url()->current() }}",
        "itemOffered": {
          "@type": "Service",
          "name": "{{ $service->name }}",
          "description": "{{ $service->short_description }}",
          "serviceType": "{{ $service->name }}"
        }
      }
    }
</script>
@endsection

@section('content')
    <section class="relative md:h-48 py-5 bg-cover bg-center" style="background-image: url('{{ $service->banner }}')">
        <div class="absolute inset-0 bg-black/80"></div>
        <div class="container mx-auto px-6 md:px-0 h-full flex items-center relative">
            <div class="text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">{{ $service->name }}</h1>
                <p class="text-xl">{{ $service->sort_description }}</p>
            </div>
        </div>
    </section>
    <div class="container mx-auto px-5 md:px-0">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 mt-8">
            <div class="md:col-span-8 @if (count($services) <= 1) lg:col-span-12 @endif">
                @isset($service?->banner)
                    <div class="relative">
                        <img src="{{ $service?->banner }}" alt="{{ $service?->name }}" class="w-full h-auto rounded-lg mb-6">
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 rounded-b-lg">
                            <h2 class="text-lg font-semibold text-white">{{ $service?->name }}</h2>
                            <p class="text-sm text-gray-300">{{ $service?->sort_description }}</p>
                        </div>
                    </div>
                @endisset
                {{-- service content --}}
                @isset($service?->content)
                    <div class="rounded-t-lg overflow-hidden prose mb-10 border shadow-md p-5 border-gray-200">
                        {!! $service?->content?->html !!}</div>
                @endisset
                {{-- book a appointment btn --}}
                <div class="bg-gray-600 p-4 rounded-lg mb-10">
                    <div class="container mx-auto px-5 md:px-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-white text-2xl font-bold">Book an Appointment</h2>
                                <p class="text-white">Experience expert dental care that brings out the best in your
                                    smile—bright,
                                    confident, and beautifully aligned.</p>
                            </div>
                            <a href="{{ route('public.appointment') }}"
                                class="bg-white text-gray-600 px-6 py-2 whitespace-nowrap rounded-full font-semibold hover:bg-teal-500 hover:text-white transition duration-300">Book
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-4 @if (count($services) <= 1) lg:col-span-12 @endif">
                <div class="bg-white rounded-lg shadow-md p-6 mb-10 border border-gray-200 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4">Other Services</h2>
                    <ul class="space-y-4">
                        @foreach ($services as $item)
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
