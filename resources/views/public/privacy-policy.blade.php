@extends('layouts.public.app')
@section('content')
    <div class="pt-4 bg-gray-100 py-16">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div
                class="w-full sm:max-w-4xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose dark:prose-invert">
                <header>
                    <h3>Privacy Policy</h3>
                    <p>Last Updated: February 2025</p>
                </header>

                <section class="mt-4">
                    <h3 class="mb-1">1. Information We Collect</h3>
                    <p class="text-gray-500">We collect the following personal data when you use our website:</p>
                    <ul class="mt-3">
                        <li><strong>Appointment Form:</strong> Name, Phone Number, Preferred Date & Time.</li>
                        <li><strong>Callback Request Form:</strong> Name, Mobile Number.</li>
                        <li><strong>Automatically Collected Data:</strong> IP address and browser type</li>
                    </ul>
                </section>

                <section class="mt-4">
                    <h3 class="mb-1">2. How We Use Your Information</h3>
                    <p class="text-gray-500">Your personal information is used for the following purposes:</p>
                    <ul class="text-gray-500">
                        <li>To schedule and manage your dental appointments.</li>
                        <li>To contact you regarding appointment confirmations or changes.</li>
                        <li>To respond to callback requests and customer inquiries.</li>
                        <li>To improve our website experience through analytics.</li>
                    </ul>
                </section>

                <section class="mt-4">
                    <h3 class="mb-1">3. Data Storage & Security</h3>
                    <p class="text-gray-500">We implement appropriate security measures to protect your personal
                        information. However, no system
                        is 100% secure, and we cannot guarantee absolute security.</p>
                </section>

                <section class="mt-4">
                    <h3 class="mb-1">4. Data Sharing & Third-Party Services</h3>
                    <p class="text-gray-500">We do not sell or rent your personal data. However, we may share it with:</p>
                    <ul class="text-gray-500">
                        <li>Legal authorities if required by law.</li>
                    </ul>
                </section>

                <section class="mt-4">
                    <h3 class="mb-1">5. Cookies & Tracking</h3>
                    <p class="text-gray-500">We use cookies to enhance your browsing experience. You can disable cookies in
                        your browser settings.
                    </p>
                </section>

                <section class="mt-4">
                    <h3 class="mb-1">6. Your Rights</h3>
                    <p class="text-gray-500">You have the right to:</p>
                    <ul class="text-gray-500">
                        <li>Request access to your stored data.</li>
                        <li>Request data deletion or modification.</li>
                        <li>Opt out of marketing communications.</li>
                    </ul>
                    <p>To request any changes, contact us at <strong>realigndent@gmail.com</strong>.</p>
                </section>

                <section class="mt-4">
                    <h3 class="mb-1">7. Changes to This Privacy Policy</h3>
                    <p>We may update this policy at any time. Please check back regularly for updates.</p>
                </section>

                <footer class="mt-6">
                    <a href="{{ route('public.terms') }}" class="text-[teal]">View Terms & Conditions</a>
                </footer>
            </div>
        </div>
    </div>
@endsection
