@extends('layouts.public.app')
@section('content')
    <section class="py-10 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="mb-10">
                <h1 class="text-3xl font-bold mb-4 text-[teal]">Our Comprehensive Sterilization Process</h1>
                <p class="text-gray-700">At Realign Dental, patient safety is not just a protocol — it’s a promise. Our
                    sterilization standards have always exceeded expectations, not just during the pandemic but as a core
                    part of our daily practice. Our rigorous 4-Step Sterilization Process ensures every instrument is 100%
                    safe and sterilized before it touches a patient. We even sterilize drilling handpieces and bits after
                    every use.</p>
                <p class="text-gray-700 mt-2">To reinforce our commitment to transparency and hygiene, we open sealed,
                    sterile instrument pouches in front of each patient. At Realign Dental, you’re always in safe hands.</p>
            </div>
            <div class="space-y-3">
                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <img src="{{ asset('images/safety/cleaning&Disinfection.webp') }}"
                        class="md:h-32 md:w-32 object-cover rounded-lg shadow-lg">
                    <div class="flex mb-6 gap-3">
                        <div>
                            <h2 class="text-xl font-bold mb-2 text-[teal]">Step 1: Initial Cleaning & Disinfection</h2>
                            <p class="text-gray-700">All instruments are immersed in a disinfectant solution for at least 30
                                All instruments are immersed in a disinfectant solution for at least 30 minutes. They are
                                then scrubbed thoroughly under running water using a cleansing solution to remove all
                                visible debris and organic material.</p>
                        </div>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row gap-4">
                    <img src="{{ asset('images/safety/ultrasonic_cleaner.webp') }}"
                        class="md:h-32 md:w-32 object-cover rounded-lg shadow-lg">
                    <div class="flex mb-6 gap-3">
                        <div>
                            <h2 class="text-xl font-bold mb-2 text-[teal]">Step 2: Ultrasonic Cleaning & Pouching</h2>
                            <p class="text-gray-700">Next, the instruments are cleaned in an ultrasonic cleaner to remove
                                any microscopic particles. Once dried, they are sealed in medical-grade sterilization
                                pouches to prevent contamination.</p>
                        </div>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row gap-4">
                    <img src="{{ asset('images/safety/IMG_1707.webp') }}"
                        class="md:h-32 md:w-32 object-cover rounded-lg shadow-lg">
                    <div class="flex mb-6 gap-3">
                        <div>
                            <h2 class="text-xl font-bold mb-2 text-[teal]">Step 3: Class B Autoclave Sterilization</h2>
                            <p class="text-gray-700">The pouched instruments are placed in a Class B Autoclave — the gold
                                standard in sterilization. This ensures the elimination of all forms of bacteria, viruses,
                                and spores by using high-pressure steam cycles.</p>
                        </div>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="flex flex-col md:flex-row gap-4">
                    <img src="{{ asset('images/safety/DSC03092.webp') }}"
                        class="md:h-32 md:w-32 object-cover rounded-lg shadow-lg">
                    <div class="flex mb-6 gap-3">
                        <div>
                            <h2 class="text-xl font-bold mb-2 text-[teal]">Step 4: UV Sterile Storage</h2>
                            <p class="text-gray-700">Finally, the sterilized instruments are stored in UV light cabinets
                                until use. This maintains the sterility of instruments and ensures they remain
                                contamination-free until the moment they are opened in front of the patient.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
