<section id="services" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Our Treatments</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Comprehensive dental care tailored to your needs. We offer a wide
                range of services using the latest technology and techniques.</p>
        </div>
        <div class="grid md:grid-cols-4 gap-8">
            @foreach ($services as $service)
                <div
                    class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow border border-gray-200 overflow-hidden group">
                    <div class="h-40 relative overflow-hidden">
                        <img src="{{ $service->getFirstMediaUrl('banner') ?? asset('images/service/service1.jpg') }}"
                            class="w-full h-full object-cover object-center transform group-hover:scale-110 transition-transform duration-300"
                            alt="General Dentistry">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="absolute top-4 left-4">
                            <div
                                class="w-8 h-8 text-primary flex items-center justify-center bg-white/90 backdrop-blur-sm rounded-full">
                                @if ($service->icon)
                                    {!! $service->icon !!}
                                @else
                                    <x-icons.check class="w-5 h-5" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-2 text-primary transition-colors line-clamp-1">
                            {{ $service->name }}
                        </h3>
                        <p class="text-gray-600 mb-4 text-sm line-clamp-2">{{ $service->tagline }}</p>
                        <a href="{{ route('public.service.show', $service->slug) }}"
                            class="inline-flex items-center text-primary hover:text-primary/80 font-medium group">
                            Learn More
                            <svg xmlns="http://www.w3.org/2000/svg" width="20   " height="20   " fill="currentColor"
                                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-12">
            <a href="{{ route('public.about') }}"
                class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                View All Services
            </a>
        </div>
    </div>
</section>
