@extends('layouts.public.app')

@section('content')
    <section class="relative h-[40vh] bg-cover bg-center"
        style="background-image: url('{{ asset('images/about/about.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
        <div class="container mx-auto px-6 h-full flex items-center relative">
            <div class="text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-6">Excellence in {{ config('app.name') }}</h1>
                <p class="text-xl">Your smile is our top priority.</p>
            </div>
        </div>
    </section>
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-6 text-[teal]">Our Mission</h2>
                <p class="text-xl text-gray-600 mb-12">To provide exceptional dental care in a comfortable and
                    welcoming environment, ensuring every patient achieves optimal oral health through personalized
                    treatment and education.</p>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="p-6 bg-white rounded-lg shadow-sm">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-[teal]/30 rounded-full">
                            <x-icons.heart />
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Patient-Centered Care</h3>
                        <p class="text-gray-600">Your comfort and satisfaction are our top priorities</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow-sm">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-[teal]/30 rounded-full">
                            <x-icons.star class="text-[teal] h-8 w-8" />
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Excellence</h3>
                        <p class="text-gray-600">Committed to the highest standards in dental care</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow-sm">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-[teal]/30 rounded-full">
                            <x-icons.people class="text-[teal] h-8 w-8" />
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Community Focus</h3>
                        <p class="text-gray-600">Building lasting relationships with our patients</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="font-montserrat font-bold text-3xl md:text-4xl mb-4 text-[teal]"> What Our Patients Say</h2>
                <div class="h-1 w-24 bg-[teal] mx-auto"></div>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">
                    We take pride in our patient satisfaction. Here are some testimonials from our happy patients who have
                    experienced the Realign Dental difference.
                </p>
            </div>
            <div class="relative testimonial-slider">
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 testimonial-track">
                        @foreach ($reviews as $review)
                            <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                                <div class="bg-[teal]/10 p-6 rounded-lg h-full relative">
                                    <div
                                        class="w-8 h-8 flex items-center justify-center text-primary-300 absolute top-4 left-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" z="30" class="text-[teal]"
                                            fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16">
                                            <path
                                                d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z" />
                                        </svg>
                                    </div>
                                    <div class="pt-6">
                                        <p class="text-gray-700 mb-6 line-clamp-7">{{ $review->content }}</p>
                                        <div class="flex items-center">
                                            <div class="flex text-primary-500 mb-2">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                    <x-icons.star class="h-5 w-5 text-[teal]" />
                                                @endfor
                                            </div>
                                        </div>
                                        <h5 class="font-semibold text-primary-600">{{ $review->author }}</h5>
                                        <p class="text-gray-600 text-sm">{{ $review->date->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center mt-8 gap-2">
                        <button class="w-3 h-3 rounded-full bg-[teal]/30 testimonial-dot" data-index="0"></button>
                        <button class="w-3 h-3 rounded-full bg-[teal]/30 testimonial-dot" data-index="1"></button>
                        <button class="w-3 h-3 rounded-full bg-[teal]/30 testimonial-dot" data-index="2"></button>
                        <button class="w-3 h-3 rounded-full bg-[teal]/30 testimonial-dot" data-index="3"></button>
                    </div>
                    <div
                        class="absolute top-1/2 -translate-y-1/2 left-0 w-10 h-10 flex items-center justify-center bg-white !rounded-full shadow-md text-primary-600 cursor-pointer testimonial-prev">
                        <x-icons.chevronRight class="rotate-180" />
                    </div>
                    <div
                        class="absolute top-1/2 -translate-y-1/2 right-0 w-10 h-10 flex items-center justify-center bg-white !rounded-full shadow-md text-primary-600 cursor-pointer testimonial-next">
                        <x-icons.chevronRight />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-4xl font-bold mb-8">Contact Us</h2>
                    <div class="bg-white p-8 rounded-lg shadow-sm border">
                        <form id="contactForm" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input type="text"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary h-32"
                                    required></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-[teal] text-white px-6 py-3 rounded hover:bg-opacity-90">Send
                                Message</button>
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-bold mb-8">Visit Us</h2>
                    <div class="bg-white p-8">
                        <div class="mb-8">
                            <div class="h-64 rounded-lg overflow-hidden mb-6">
                                <iframe title="contact"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3494.8550309505263!2d75.76734117536064!3d26.84802237668571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db59eb3847cd7%3A0xa95d826797f4fc0d!2sREALIGN%20DENTAL%20CLINIC!5e1!3m2!1sen!2sin!4v1739618310902!5m2!1sen!2sin"
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    aria-controls="contact" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                            <h4 class="text-xl font-bold text-gray-600">Dr. Arora’s ReAlign Dental Clinic
                                            </h4>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call-to-Action -->
    <section id="cta" class="py-16 bg-[teal] text-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-6">Ready to Transform Your Smile?</h3>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Schedule your comprehensive dental consultation today and take the
                first step toward optimal oral health and a confident smile.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('public.appointment') }}"
                    class="bg-white text-primary-600 px-8 py-3 rounded-lg font-medium text-[teal] transition whitespace-nowrap">Schedule
                    Your Visit</a>
                <a href="{{ route('public.contact') }}"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-[teal]/70 transition whitespace-nowrap">Contact
                    Us</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Testimonial Slider
            const track = document.querySelector(".testimonial-track");
            const dots = document.querySelectorAll(".testimonial-dot");
            const prevBtn = document.querySelector(".testimonial-prev");
            const nextBtn = document.querySelector(".testimonial-next");
            let currentIndex = 0;
            const updateSlider = () => {
                let slideWidth = 100;
                if (window.innerWidth >= 768 && window.innerWidth < 1024) {
                    slideWidth = 50; // 2 slides visible on medium screens
                } else if (window.innerWidth >= 1024) {
                    slideWidth = 33.333; // 3 slides visible on large screens
                }
                track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.add("bg-[teal]");
                        dot.classList.remove("bg-[teal]/30");
                    } else {
                        dot.classList.add("bg-[teal]/30");
                        dot.classList.remove("bg-[teal]");
                    }
                });
            };
            dots.forEach((dot, index) => {
                dot.addEventListener("click", () => {
                    currentIndex = index;
                    updateSlider();
                });
            });
            prevBtn.addEventListener("click", () => {
                currentIndex = Math.max(0, currentIndex - 1);
                updateSlider();
            });
            nextBtn.addEventListener("click", () => {
                const maxIndex = dots.length - 1;
                currentIndex = Math.min(maxIndex, currentIndex + 1);
                updateSlider();
            });
            // Update on resize
            window.addEventListener("resize", updateSlider);
            // Initialize
            updateSlider();
        });
    </script>
@endpush
