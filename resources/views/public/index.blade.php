@extends('layouts.public.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
@endpush

@section('content')
    {{-- #c0c4c1, #C5C8C8, #C9CACB --}}
    <section class="relative h-[600px] flex items-center banner">
        <div class="absolute inset-0 bg-black/50 md:bg-black/10"></div>
        <div class="container mx-auto px-4 relative z-10 mt-72 md:mt-20">
            <div class="max-w-2xl text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-3 md:mb-6 animate-slideIn">Align. Smile. Shine! ✨</h1>
                <p class="text-base md:text-xl mb-4 md:mb-8 animate-fadeIn" style="animation-delay: 0.3s">Experience expert dental care that
                    brings out the best in your<br /> smile—bright, confident, and beautifully aligned.</p>
                <a href="{{ route('public.appointment') }}"
                    class="bg-[teal] text-white px-4 py-2 md:px-8 md:py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap text-lg animate-scaleIn animate-bounce"
                    style="animation-delay: 0.6s">
                    Schedule Your Visit
                </a>
            </div>
        </div>
    </section>
    {{-- about --}}
    <section id="about" class="py-24">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <img src="{{ asset('images/about/about.jpg') }}"
                        onerror="this.onerror=null; this.src='{{ asset('images/about/about.jpg') }}';"
                        class="rounded-lg shadow-lg w-full" alt="About Our Clinic" />
                </div>
                <div>
                    <h2 class="text-4xl font-bold mb-6 text-[teal]">About Our Clinic</h2>
                    <p class="text-gray-600 mb-8">
                        Welcome to Realign Dental Clinic, where we combine advanced
                        technology with compassionate care to deliver exceptional dental
                        services. Our state-of-the-art facility is designed to provide you
                        with the most comfortable and efficient dental experience
                        possible.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 flex items-center justify-center bg-[teal] rounded-full text-white">
                                <x-icons.people class="w-6 h-6" />
                            </div>
                            <div>
                                <h3 class="font-bold text-[teal]">Expert Team</h3>
                                <p class="text-gray-600 text-sm">Experienced professionals</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 flex items-center justify-center bg-[teal] rounded-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fisll-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[teal]">Zero Pain Policy</h3>
                                <p class="text-gray-600 text-sm">Painfree dental treatment</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 flex items-center justify-center bg-[teal] rounded-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                    <path
                                        d="M10.058.501a.5.5 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.5.5 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.5.5 0 0 1-.497-.499" />
                                    <path
                                        d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1z" />
                                    <path d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[teal]">Patient Care</h3>
                                <p class="text-gray-600 text-sm">Personalized attention</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 flex items-center justify-center bg-[teal] rounded-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[teal]">Safety First</h3>
                                <p class="text-gray-600 text-sm">Strict protocols</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('public.about') }}"
                        class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                        Learn More About Us
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Our treatments -->
    <section id="services" class="section-padding bg-gray-50 py-[5rem] px-[1.5rem]">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-montserrat font-bold text-3xl md:text-4xl mb-4 text-[teal]">Our Treatments</h2>
                <div class="h-1 w-24 bg-[teal] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">We offer comprehensive dental care for patients of all ages,
                    focusing on preventive care, cosmetic improvements, and restorative treatments.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Service 1 -->
                @foreach ($services as $service)
                    <div class="bg-white rounded-md shadow-sm hover:shadow-lg transition-all overflow-hidden">
                        <a href="{{ route('public.service.show', $service->slug) }}">
                            <img src="{{ $service->banner }}" alt="{{ $service->name }}" class="w-full object-contain">
                            <div class="p-6">
                                <h3 class="text-[1.1rem] font-semibold text-[teal] mb-3">{{ $service->name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-4">{{ $service->sort_description }}</p>
                                <a href="{{ route('public.service.show', $service->slug) }}"
                                    class="font-medium text-[teal] hover:text-[teal]/50 transition-all flex items-center">Learn
                                    More
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <a href="{{ route('public.services') }}"
                    class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap mt-8">
                    View All Services
                </a>
            </div>
        </div>
    </section>
    {{-- after before --}}
    <section id="before-after" class="section-padding bg-white py-[5rem] px-[1.5rem]">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-montserrat font-bold text-3xl md:text-4xl mb-4 text-[teal]">Before & After</h2>
                <div class="h-1 w-24 bg-[teal] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">See the amazing transformations we've achieved for our
                    patients through our expert dental care.</p>
            </div>
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative overflow-hidden flex justify-center">
                    <div id="after-before-container" aria-label="Before and after image slider"
                        class="rounded-lg overflow-hidden m-auto">
                        <div class="img-wrapper">
                            <img src="{{ asset('images/before_after/1.JPG') }}"
                                onerror="this.onerror=null; this.src='{{ asset('images/before_after/1.webp') }}';"
                                alt="Before" loading="lazy">
                        </div>
                        <div class="img-wrapper">
                            <img src="{{ asset('images/before_after/2.JPG') }}"
                                onerror="this.onerror=null; this.src='{{ asset('images/before_after/2.webp') }}';"
                                alt="After" loading="lazy">
                        </div>
                        <div id="line"></div>
                        <input id="slider" type="range" min="0" max="100" value="50">
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-6 text-[teal]">Complete Smile Makeover</h3>
                    <p class="text-gray-600 mb-6">Patient was not confident about his smile</p>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/10 rounded-full">
                                <x-icons.check class="text-[teal]" />
                            </div>
                            <span class="text-gray-600">Rotations in multiple teeth along with gaps between all
                                teeth.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/10 rounded-full">
                                <x-icons.check class="text-[teal]" />
                            </div>
                            <span class="text-gray-600">Invisible aligners therapy.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/10 rounded-full">
                                <x-icons.check class="text-[teal]" />
                            </div>
                            <span class="text-gray-600">Total treatment time: 11 months.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/10 rounded-full">
                                <x-icons.check class="text-[teal]" />
                            </div>
                            <span class="text-gray-600">Patient satisfaction: Extremely happy and confident.</span>
                        </li>
                    </ul>
                    <div class="mt-8">
                        {{-- <p class="text-gray-600 mb-6">Treatment Duration: 3 months<br>Patient Satisfaction: Extremely Happy
                        </p> --}}
                        <a href="{{ route('public.appointment') }}"
                            class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                            Schedule Consultation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- team --}}
    <section id="team" class="section-padding bg-gray-50 py-[5rem] px-[1.5rem]">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-montserrat font-bold text-3xl md:text-4xl mb-4 text-[teal]">Meet Our Team</h2>
                <div class="h-1 w-24 bg-[teal] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">Our team of experienced dental professionals is committed
                    to providing you with the highest quality care in a comfortable environment.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                @foreach ($teams as $member)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all overflow-hidden">
                        <img src="{{ $member->image }}" alt="{{ $member->name }}" class="w-full object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[teal] mb-1">{{ $member->name }}</h3>
                            <p class="text-gray-600 font-medium mb-3">{{ $member->designation }}</p>
                            <p class="text-gray-600 text-[15px] mb-4 line-clamp-3">{{ $member->sort_description }}</p>
                            <div class="flex space-x-3">
                                <a href="{{ route('public.doctor.show', $member->slug) }}"
                                    class="text-[teal] hover:text-[teal]/50">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- review --}}
    <section id="patient-reviews" class="section-padding bg-white py-[5rem] px-[1.5rem]">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-montserrat font-bold text-3xl md:text-4xl mb-4 text-[teal]">Patient Testimonials</h2>
                <div class="h-1 w-24 bg-[teal] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">See what our patients have to say about their experience at
                    Realign Dental Clinic</p>
            </div>
            <div class="swiper review-swiper">
                <div class="swiper-wrapper py-5">
                    @foreach ($reviews as $review)
                        <div
                            class="swiper-slide bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-all border border-gray-200">
                            <div class="flex text-yellow-400 mb-4 gap-1">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <x-icons.star class="w-5" />
                                @endfor
                            </div>
                            <div class="mb-6">
                                <p class="text-gray-600 line-clamp-4s line-clamp-4">
                                    {{ $review->content }}
                                </p>
                                <a href="{{ route('public.review.show', $review) }}"
                                    class="text-blue-500 hover:underline">Read
                                    more</a>
                            </div>
                            <div class="flex items-center mt-2">
                                @if ($review->image)
                                    <img src="{{ $review->image }}" class="w-12 h-12 rounded-full mr-4"
                                        alt="{{ $review->author }}" />
                                @else
                                    <img src=https://ui-avatars.com/api/?name={{ $review->author }}&color=7F9CF5&background=EBF4FF
                                        class="w-12 h-12 rounded-full mr-4" alt="{{ $review->author }}" />
                                @endif
                                <div>
                                    <h4 class="font-semibold">
                                        {{ $review->author }}
                                    </h4>
                                    <p class="text-gray-600 text-sm">
                                        {{ $review->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-8 flex justify-center">
                <a href="{{ route('public.reviews') }}"
                    class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                    View All Reviews
                </a>
            </div>
        </div>
    </section>
    <!-- YouTube Videos Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-3 text-[teal]">
                    Educational Videos
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Watch our informative videos about dental procedures, oral health tips, and patient testimonials.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Video 1 -->
                @foreach ($youtubeVideos as $video)
                    <a href="{{ route('public.video-player') }}?video={{ $video->id }}"
                        class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="relative pb-[56.25%]">
                            <img src="{{ $video->thumbnail }}" alt="Video Thumbnail"
                                class="absolute inset-0 w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                <div
                                    class="w-16 h-16 flex items-center justify-center bg-white/90 rounded-full cursor-pointer hover:bg-white transition">
                                    <x-icons.play class="text-[teal] w-8 h-8" />
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">
                                {{ $video->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">
                                {{ $video->description }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="https://www.youtube.com/@RealignDental/videos" target="_blank"
                    class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                    View All Videos
                </a>
            </div>
        </div>
    </section>
    <!-- Reels, Blogs & Articles Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-3 text-[teal]">
                    Latest Updates & Resources
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Stay informed with our latest dental reels, blog posts, and
                    educational articles.
                </p>
            </div>
            <!-- Reels Section -->
            <div class="mb-16">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach ($reels as $reel)
                        <a href="{{ route('public.reels-player') }}?reel={{ $reel->id }}"
                            class="relative rounded-lg overflow-hidden cursor-pointer group">
                            <div class="aspect-[9/16] bg-gray-200">
                                <img src="{{ $reel->poster }}" alt="Dental Care Reel"
                                    class="w-full h-full object-cover" />
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-3">
                                <div class="text-white">
                                    <p class="text-sm font-medium">{{ $reel->title }}</p>
                                    <div class="flex items-center text-xs mt-1">
                                        <i class="ri-heart-line mr-1"></i>
                                        <span>2.5K</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- faqs --}}
    {{-- FAQs --}}
    <section id="faqs" class="section-padding bg-gray-50 py-[5rem] px-[1.5rem]">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-montserrat font-bold text-3xl md:text-4xl mb-4 text-[teal]">Frequently Asked Questions</h2>
                <div class="h-1 w-24 bg-[teal] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">Find answers to common questions about our dental services,
                    appointments, and patient care.</p>
            </div>
            <div class="max-w-3xl mx-auto">
                @foreach ($faqs as $faq)
                    <div class="faq-item mb-4 border-b border-gray-200">
                        <button class="w-full text-left py-4 flex justify-between items-center focus:outline-none"
                            onclick="toggleFaq(this)">
                            <h3 class="text-lg font-semibold text-[teal]">{{ $faq->question }}</h3>
                            <svg class="w-6 h-6 text-[teal] transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden text-gray-600 pb-4">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('public.faqs') }}"
                    class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                    View All FAQs
                </a>
            </div>
        </div>
    </section>
    {{-- end faqs --}}
    {{-- contact --}}
    <section id="contact" class="section-padding bg-white py-[5rem] px-[1.5rem]">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <div class="mb-8">
                        <h2 class="text-4xl font-bold text-[teal] mb-2">Contact Us</h2>
                        <p class="text-gray-600 mb-6">We are here to help you with all your dental needs. Feel free to
                            reach
                            out to us for any inquiries or to schedule an appointment.</p>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-[teal]/10 rounded-full flex-shrink-0">
                                <x-icons.location />
                            </div>
                            <div>
                                <h3 class="font-bold mb-2 text-[teal]">Location</h3>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-600">Dr. Arora’s ReAlign Dental Clinic</h4>
                                    <p class="text-gray-600">
                                        Ground Floor, 94/40, Vijay Path, Mansarovar<br /> Jaipur, Rajasthan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-[teal]/10 rounded-full flex-shrink-0">
                                <x-icons.calendar />
                            </div>
                            <div>
                                <h3 class="font-bold mb-2 text-[teal]">Working Hours</h3>
                                <p class="text-gray-600">
                                    Monday - Sunday: 10:00 AM to 2:00 PM, 4:00 PM to 8:00 PM
                                </p>
                                <p class="text-gray-600">
                                    Tuesday: 4:00 PM to 8:00 PM
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-[teal]/10 rounded-full flex-shrink-0">
                                <x-icons.contact />
                            </div>
                            <div>
                                <h3 class="font-bold mb-2 text-[teal]">Contact</h3>
                                <p class="text-gray-600">
                                    Phone: <b>+91 7891012206</b><br>
                                    Email: <b>realigndent@gmail.com</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-800 rounded-lg overflow-hidden h-[450px] border border-gray-700 flex items-center justify-center">
                    <iframe title="Google Map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3494.8550309505263!2d75.76734117536064!3d26.84802237668571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db59eb3847cd7%3A0xa95d826797f4fc0d!2sREALIGN%20DENTAL%20CLINIC!5e1!3m2!1sen!2sin!4v1739618310902!5m2!1sen!2sin"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        aria-controls="contact" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const slider = document.getElementById('slider');
        const line = document.getElementById('line');
        const imgAfter = document.querySelector('.img-wrapper:nth-of-type(2)');

        slider.addEventListener('input', function() {
            const value = slider.value + '%';
            line.style.left = value;
            imgAfter.style.clipPath = `inset(0px 0px 0px ${value})`;
        });

        slider.addEventListener('dblclick', function() {
            slider.value = 50;
            line.style.left = '50%';
            imgAfter.style.clipPath = 'inset(0px 0px 0px 50%)';
        });
    </script>

    <script src="{{ asset('vendor/swiper/js/swiper-bundle.min.js') }}"></script>
    <script>
        const swiper = new Swiper('.review-swiper', {
            direction: 'horizontal',
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
    </script>

    <script>
        function toggleFaq(button) {
            const answer = button.nextElementSibling;
            const icon = button.querySelector('svg');
            answer.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
@endpush
