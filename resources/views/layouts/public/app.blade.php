<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Setup -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dr. Anjali Uttwani">
    <meta name="robots" content="index, follow">
    <meta name="referrer" content="no-referrer-when-downgrade">

    <!-- Canonical & Language Settings -->
    <link rel="canonical" href="@yield('meta_canonical', url()->current())">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">

    <!-- Page Title & Meta Descriptions for SEO -->
    <title>@yield('title', config('app.name') . ' - Best Dental Care & Smile Makeover')</title>
    <meta name="description" content="@yield('meta_description', config('app.name') . ' provides expert dental services including implants, braces, teeth whitening, and more. Visit us for a perfect smile!')">
    <meta name="keywords" content="@yield('meta_keywords', 'Dental Clinic, Best Dentist, Teeth Whitening, Dental Implants, Root Canal, Braces, Oral Surgery, Smile Makeover, Cosmetic Dentistry, Best Dental Care in India')">

    <!-- Favicon and Icons -->
    <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('images/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512"
        href="{{ asset('images/favicon/android-chrome-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

    <!-- App Appearance on Mobile -->
    <meta name="application-name" content="Realign Dental Clinic">
    <meta name="apple-mobile-web-app-title" content="Realign Dental">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#008080">
    <meta name="msapplication-TileColor" content="#008080">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/favicon-32x32.png') }}">

    <!-- Open Graph / Facebook Meta -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('meta_og_title', config('app.name') . ' - Trusted Dental Experts')">
    <meta property="og:description" content="@yield('meta_og_description', 'Get top-quality dental care at ' . config('app.name') . '. From routine checkups to cosmetic dentistry, we ensure a bright and healthy smile!')">
    <meta property="og:image" content="@yield('meta_og_image', asset('images/doctors/1.webp'))">

    <!-- Twitter Card Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_twitter_title', config('app.name') . ' - Smile with Confidence!')">
    <meta name="twitter:description" content="@yield('meta_twitter_description', 'Expert dental services to keep your smile bright and healthy. Book your appointment today!')">
    <meta name="twitter:image" content="@yield('meta_twitter_image', asset('images/doctors/1.webp'))">

    {{-- whatsapp bot --}}

    <!-- Structured Data Schema (Dynamic Slot) -->
    @yield('schema.org', '')

    <!-- CSS & Stylesheets -->
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper-bundle.min.css') }}">
    @vite(['resources/css/app.css'])
    {{-- <script type="text/javascript" src="https://d3mkw6s8thqya7.cloudfront.net/integration-plugin.js" id="aisensy-wa-widget" widget-id="aaaiqw"> --}}
    <script type="text/javascript" src="https://d3mkw6s8thqya7.cloudfront.net/integration-plugin.js" id="aisensy-wa-widget"
        widget-id="aaai9e"></script>
    </script>
    @stack('styles')
</head>

<body>
    {{-- loader --}}
    <div id="loader" class="fixed inset-0 z-50 bg-white flex items-center justify-center">
        <img src="{{ asset('images/logo/logo-png.png') }}" alt="Loading..." class="h-24 animate-bounce">
    </div>
    {{-- <div class="hidden lg:block border-b border-gray-200 topbar">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-12">
                <div class="flex space-x-6 text-sm text-gray-600">
                    <a href="{{ route('public.about') }}"
                        class="hover:text-gold @if (request()->routeIs('public.about')) text-[teal] @endif">About</a>
                    <a href="{{ route('public.reviews') }}"
                        class="hover:text-[teal] @if (request()->routeIs('public.reviews')) text-[teal] @endif">Reviews</a>
                    <a href="{{ route('public.contact') }}"
                        class="hover:text-[teal] @if (request()->routeIs('public.contact')) text-[teal] @endif">Contact</a>
                </div>
                <div class="flex space-x-5 text-sm text-gray-600">
                    <a href="tel:+917891012206" class="hover:text-[teal]" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </a>
                    <a href="mailto:realigndent@gmail.com" class="hover:text-[teal]" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/realigndentalclinic/" class="hover:text-[teal]"
                        target="_blank">
                        <x-icons.instagram />
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="w-full z-40 bg-white navbar sticky top-0">
        <header class="shadow-sm">
            <div class="container mx-auto px-4">
                <nav class="flex justify-between items-center h-20">
                    <div class="flex-shrink-0">
                        <a href="/" class="flex items-center">
                            <img src="{{ asset('images/logo/logo-png.png') }}" alt="Realign Dental Logo"
                                class="h-14">
                        </a>
                    </div>
                    <button id="mobile-menu-button"
                        class="xl:hidden p-2 rounded-md text-gray-600 hover:text-[teal] hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="hidden xl:flex items-center space-x-5">
                        <a href="{{ route('public.index') }}"
                            class="{{ request()->routeIs('public.index') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Home</a>
                        <a href="{{ route('public.about') }}"
                            class="{{ request()->routeIs('public.about') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">About</a>
                        <a href="{{ route('public.doctors') }}"
                            class="{{ request()->routeIs('public.doctors') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Our
                            Team</a>
                        <div class="relative group">
                            <button class="flex items-center text-gray-600 hover:text-gold group">
                                Treatments
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute left-0 w-72 bg-white rounded-md shadow-lg py-1 hidden group-hover:block border">
                                @foreach ($commonServices as $service)
                                    <a href="{{ route('public.service.show', $service->slug) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 truncate">{{ $service->name }}</a>
                                @endforeach
                                <a href="{{ route('public.services') }}"
                                    class="block px-4 py-2 text-sm text-[teal] hover:bg-gray-100">View All
                                    Treatments</a>
                            </div>
                        </div>
                        <div class="relative group">
                            <button class="flex items-center text-gray-600 hover:text-gold group">
                                Patient Safety
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute left-0 w-72 bg-white rounded-md shadow-lg py-1 hidden group-hover:block border">
                                <a href="{{ route('public.patient-safety.10x-safety') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->routeIs('public.patient-safety.10x-safety') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">10x
                                    Safety</a>
                                <a href="{{ route('public.patient-safety.sterilization') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->routeIs('public.patient-safety.sterilization') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">4
                                    Step Sterilization</a>
                                <a href="{{ route('public.patient-safety.safety-equipment') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->routeIs('public.patient-safety.safety-equipment') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Safety
                                    Equipment</a>
                                <a href="{{ route('public.patient-safety.equipment-technology') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->routeIs('public.patient-safety.equipment-technology') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Equipment
                                    & Technology</a>
                                <a href="{{ route('public.patient-safety.quality') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 {{ request()->routeIs('public.patient-safety.quality') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Quality</a>
                            </div>
                        </div>
                        <a href="{{ route('public.gallery') }}"
                            class="{{ request()->routeIs('public.gallery') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Our
                            Gallery</a>
                        <a href="{{ route('public.contact') }}"
                            class="{{ request()->routeIs('public.contact') ? 'text-gold' : 'text-gray-600 hover:text-gold' }}">Contact
                            Us</a>
                    </div>
                    <div class="hidden xl:block">
                        <a href="{{ route('public.appointment') }}"
                            class="inline-flex items-center px-6 py-text-gold text-white font-medium bg-[teal] hover:bg-transparent hover:text-teal-700 border hover:border-teal-700 py-2.5 rounded-md transition-colors">
                            Book Appointment
                        </a>
                        <a href="{{ route('public.callback-request') }}"
                            class="inline-flex items-center px-6 py-text-gold font-medium border text-[teal] border-[teal] hover:text-white hover:bg-[teal] py-2.5 rounded-md hovetext-gold/90 transition-colors">
                            Request Callback
                        </a>
                    </div>
                </nav>
            </div>
        </header>
        <div id="mobile-menu" class="xl:hidden hidden bg-white border-t">
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('public.index') }}"
                        class="{{ request()->routeIs('public.index') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Home</a>
                    <a href="{{ route('public.about') }}"
                        class="{{ request()->routeIs('public.about') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">About</a>
                    <a href="{{ route('public.doctors') }}"
                        class="{{ request()->routeIs('public.doctors') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Our
                        Team</a>
                    <a href="{{ route('public.services') }}"
                        class="{{ request()->routeIs('public.services') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Treatments</a>
                    <div class="relative">
                        <button onclick="toggleMobileDropdown('patientSafety-dropdown')"
                            class="w-full text-left text-gray-600 flex items-center justify-between">
                            Patient Safety
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div id="patientSafety-dropdown" class="hidden pl-4 mt-2 space-y-2">
                            <a href="{{ route('public.patient-safety.10x-safety') }}"
                                class="block {{ request()->routeIs('public.patient-safety.10x-safety') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }} py-2">10x
                                Safety</a>
                            <a href="{{ route('public.patient-safety.sterilization') }}"
                                class="block {{ request()->routeIs('public.patient-safety.sterilization') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }} py-2">4
                                Step Sterilization</a>
                            <a href="{{ route('public.patient-safety.safety-equipment') }}"
                                class="block {{ request()->routeIs('public.patient-safety.safety-equipment') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }} py-2">Safety
                                Equipment</a>
                            <a href="{{ route('public.patient-safety.equipment-technology') }}"
                                class="block {{ request()->routeIs('public.patient-safety.equipment-technology') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }} py-2">Equipment
                                & Technology</a>
                            <a href="{{ route('public.patient-safety.quality') }}"
                                class="block {{ request()->routeIs('public.patient-safety.quality') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }} py-2">Quality</a>
                        </div>
                    </div>
                    <a href="{{ route('public.gallery') }}"
                        class="{{ request()->routeIs('public.gallery') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Our
                        Gallery</a>
                    <a href="{{ route('public.contact') }}"
                        class="{{ request()->routeIs('public.contact') ? 'text-[teal]' : 'text-gray-600 hover:text-[teal]' }}">Contact
                        Us</a>
                    <a href="{{ route('public.appointment') }}"
                        class="inline-flex items-center px-6 py-text-gold text-white font-medium bg-[teal] hover:bg-transparent hover:text-teal-700 border hover:border-teal-700 py-2.5 rounded-md transition-colors">
                        Book Appointment
                    </a>
                    <a href="{{ route('public.callback-request') }}"
                        class="inline-flex items-center px-6 py-text-gold font-medium border text-[teal] border-[teal] hover:text-white hover:bg-[teal] py-2.5 rounded-md hovetext-gold/90 transition-colors">
                        Request Callback
                    </a>
                </div>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>
    <section>
        <div class="bg-white p-6 border-t border-gray-300">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-[teal]">Need Immediate Assistance?</h3>
                    <p class="text-sm text-gray-600">Our dental experts are ready to help you</p>
                </div>
                <div class="w-12 h-12 bg-[teal]/50 rounded-full flex items-center justify-center">
                    <img src="{{ asset('images/icons/call.png') }}" alt="Phone Call" class="w-6 h-6" />
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('public.callback-request') }}"
                    class="flex-1 text-[teal] border-[teal] border px-4 py-2 rounded-button hover:bg-[teal]/10 transition-colors flex items-center justify-center gap-2 rounded whitespace-nowrap">
                    <i class="ri-phone-line"></i>
                    Request Callback
                </a>
                <a href="tel:+917891012206"
                    class="flex-1 bg-[teal] text-white px-4 py-2 rounded-button hover:bg-[teal]/90 transition-colors flex items-center justify-center gap-2 rounded whitespace-nowrap">
                    <i class="ri-phone-fill"></i>
                    Call Now
                </a>
            </div>
        </div>
    </section>
    {{-- <section class="bg-white border-t border-gray-200">
        <div class="mx-auto">
            <div class="flex items-center cursor-pointer select-none justify-between px-6 border-b py-5"
                id="toggle-branches">
                <div>
                    <h2 class="text-2xl font-semibold text-[teal]">Branches</h2>
                    <p class="text-gray-600">We are located in multiple cities to serve you better. Find
                        the nearest branch for your convenience.</p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        id="branch-trigger-icon" class="bi bi-chevron-compact-right text-[teal]" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671" />
                    </svg>
                </div>
            </div>
            <div class="hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 px-10 gap-4 mt-5 border-b pb-10"
                id="branch-content">
                @foreach ($branches as $branch)
                    <div class="bg-white p-3 rounded-lg shadow-md border border-gray-200">
                        <a href="{{ route('public.branch.show', $branch->slug) }}"
                            class="text-gray-800 hover:text-[teal] transition-colors">
                            <h3 class="font-semibold text-lg text-[teal]">{{ $branch->name }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}
    <footer class="bg-gray-50 text-gray-800 py-12 border-gray-200 border-t">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <a href="#" class="text-3xl font-['Pacifico'] text-[teal] mb-4 block">
                        <img src="{{ asset('images/logo/logo-png.png') }}" alt="Realign Dental Logo" class="h-20">
                    </a>
                    <p class="text-gray-600">Align. Smile. Shine! ✨</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4 text-[teal]">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('public.index') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Home</a></li>
                        <li><a href="{{ route('public.about') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">About Us</a>
                        </li>
                        <li><a href="{{ route('public.doctors') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Our Team</a>
                        </li>
                        <li><a href="{{ route('public.services') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Treatments</a>
                        </li>
                        <li><a href="{{ route('public.gallery') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Gallery</a>
                        </li>
                        <li><a href="{{ route('public.contact') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Contact</a>
                        </li>
                        <li><a href="{{ route('public.appointment') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Book Appointment</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4 text-[teal]">Patient Safety</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('public.patient-safety.10x-safety') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">10x Safety</a></li>
                        <li><a href="{{ route('public.patient-safety.sterilization') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">4 Step Sterilization</a>
                        </li>
                        <li><a href="{{ route('public.patient-safety.safety-equipment') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Safety Equipment</a></li>
                        <li><a href="{{ route('public.patient-safety.equipment-technology') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Equipment & Technology</a>
                        </li>
                        <li><a href="{{ route('public.patient-safety.quality') }}"
                                class="text-gray-600 hover:text-[teal] transition-colors">Quality</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4 text-[teal]">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/realigndentalclinic"
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 text-[teal] rounded-full hover:bg-[teal] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                            </svg>
                        </a>
                        <a href="tel:+917891012206"
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 text-[teal] rounded-full hover:bg-[teal] hover:text-white transition-colors"
                            target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </a>
                        <a href="mailto:realigndent@gmail.com"
                            class="w-10 h-10 flex items-center justify-center bg-gray-100 text-[teal] rounded-full hover:bg-[teal] hover:text-white transition-colors"
                            target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-12 pt-8 text-center text-gray-600">
                <p>&copy; 2025 <span class="text-[teal]">Realign Dental</span>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("loader").classList.add("hidden");
            // console clear  
            console.clear();
            // console log about my business
            console.log("Welcome to Realign Dental Clinic!");
            console.log("We are dedicated to providing the best dental care for you and your family.");
            console.log("Follow us on social media for updates and tips!");
            console.log("Instagram: @realigndentalclinic");
            console.log("Contact us: +917891012206");
            console.log("Email: realigndent@gmail.com");
        });

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        function toggleMobileDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        document.getElementById('toggle-branches').addEventListener('click', function() {
            const content = document.getElementById('branch-content');
            const icon = document.getElementById('branch-trigger-icon');
            icon.classList.toggle('rotate-90');
            content.classList.toggle('grid');
            content.classList.toggle('hidden');
        });
    </script>

</body>

</html>
