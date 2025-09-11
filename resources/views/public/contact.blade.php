@extends('layouts.public.app')
@section('content')
    <!-- Banner Section -->
    <section class="relative h-[40vh] bg-cover bg-center"
        style="background-image: url('{{ asset('images/about/about.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
        <div class="container mx-auto px-6 h-full flex items-center relative">
            <div class="text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-6">Contact - {{ config('app.name') }}</h1>
                <p class="text-xl">We are here to help you with all your dental needs. Please feel free to reach out to us
                    for any
                    inquiries or to schedule an appointment.
                </p>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-4xl font-bold mb-8">Contact Us</h2>
                    <div class="bg-white p-8 rounded-lg shadow-sm">
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
@endsection
