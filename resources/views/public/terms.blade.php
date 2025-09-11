@extends('layouts.public.app')
@section('content')
    <div class="pt-4 bg-gray-100 py-16">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-4xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose ">
                <header>
                    <h1 class="mb-0 mt-0">Terms & Conditions</h1>
                    <p>Last Updated: February 2025</p>
                </header>
                <section class="mt-4">
                    <h3>1. Introduction</h3>
                    <p class="text-gray-700">Welcome to {{ config('app.name') }}. By accessing our website, you agree to
                        these Terms & Conditions.
                        If you do not agree, please do not use our treatments.</p>
                </section>
                <section class="mt-2">
                    <h3 class="mb-2">2. Website Usage</h3>
                    <ul class="text-gray-700">
                        <li>You agree not to use this website for any unlawful purpose.</li>
                        <li>You must not attempt to hack, spam, or disrupt our treatments.</li>
                        <li>We reserve the right to suspend or terminate your access at any time.</li>
                    </ul>
                </section>
                <section class="mt-2">
                    <h3 class="mb-2">3. Intellectual Property Rights</h3>
                    <p class="text-gray-700">All content on this website (text, images, logos, code) is the property of
                        {{ config('app.name') }} and
                        cannot be used without permission.</p>
                </section>
                <section class="mt-2">
                    <h3 class="mb-2">4. User Content</h3>
                    <p class="text-gray-700">By submitting any content (comments, feedback, reviews), you grant us the right
                        to use it in our
                        promotions.</p>
                </section>
                <section class="mt-2">
                    <h3 class="mb-2">5. Third-Party Services</h3>
                    <p class="text-gray-700">We may use third-party services (such as Google Analytics). We are not
                        responsible
                        for their policies.</p>
                </section>
                <section class="mt-2">
                    <h3 class="mb-2">6. Limitation of Liability</h3>
                    <p class="text-gray-700">We are not liable for any direct or indirect damages arising from the use of
                        our website.</p>
                </section>
                <section class="mt-2">
                    <h3 class="mb-2">7. Changes to These Terms</h3>
                    <p class="text-gray-700">We may update these Terms & Conditions at any time. Please review them
                        periodically.</p>
                </section>
                <footer class="mt-4 text-[teal] ">
                    <a href="{{ route('public.privacy-policy') }}">View Privacy Policy</a>
                </footer>
            </div>
        </div>
    </div>
@endsection
