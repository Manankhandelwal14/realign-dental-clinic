@extends('layouts.public.app')
@section('content')
<section class="py-10 bg-white">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h1 class="text-3xl font-bold mb-4 text-[teal]">State-of-the-Art Equipment & Technology</h1>
            <p class="text-gray-700">Realign Dental is committed to delivering modern, precise, and safe dental care. Our clinics are equipped with the latest technology, and our team is continuously trained on the best global clinical practices. This ensures our patients benefit from world-class tools and techniques for diagnostics, treatment, and hygiene.</p>
        </div>

        {{-- ASDU --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Aerosol Suction & Air Filtration System</h2>
                <p class="text-gray-700">Dental procedures generate aerosols that may carry harmful particles. To combat this, Realign Dental uses high-suction decontamination units featuring multi-layered filtration — including high-fiber cotton, fiberglass, HEPA (H13), and activated carbon filters — to maintain clean air throughout the operatory.</p>
            </div>
        </div>

        {{-- Constant Fumigation --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Constant Fumigation Technology</h2>
                <p class="text-gray-700">To ensure continuous disinfection, our clinics use advanced ultrasonic humidifiers for routine fumigation. These devices comply with European standards and eliminate microbes like viruses, bacteria, fungi, and spores — maintaining a sterile clinic environment throughout the day.</p>
            </div>
        </div>

        {{-- Dental Chairs --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Imported Dental Chairs with Anti-Backflow Technology</h2>
                <p class="text-gray-700">Our premium dental chairs are designed to prevent cross-contamination through retractable anti-backflow valves. These ensure that oral fluids never re-enter the tubing system, offering safer and cleaner treatment zones for each patient.</p>
            </div>
        </div>

        {{-- Rotary Tools --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Precision Rotary Tools</h2>
                <p class="text-gray-700">We use high-performance rotary tools imported from Germany and Japan, offering enhanced accuracy in cavity preparation. These tools help in better removal of plaque and decay, ensuring longer-lasting and more effective dental restorations.</p>
            </div>
        </div>

        {{-- X-rays --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Low-Radiation Digital X-Rays</h2>
                <p class="text-gray-700">Realign Dental uses modern digital x-ray systems that are both portable and low-radiation. Patients and staff are protected with lead aprons and thyroid collars, and we strictly follow the ALARA principle (As Low As Reasonably Achievable) to ensure maximum safety during imaging.</p>
            </div>
        </div>

        {{-- Water Filtration --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">RO-Based Water Filtration System</h2>
                <p class="text-gray-700">All water used in Realign Dental clinics is purified through reverse osmosis filtration systems, ensuring optimal hygiene and safety during procedures involving water spray or rinsing.</p>
            </div>
        </div>

        {{-- Autoclaves --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Class B Sterilization Autoclaves</h2>
                <p class="text-gray-700">Our imported autoclaves use high-pressure steam to sterilize all instruments with precision. We adhere to strict sterilization protocols to eliminate all microbes, including bacteria and spores, for every patient.</p>
            </div>
        </div>

        {{-- Consumables --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Global-Standard Dental Consumables</h2>
                <p class="text-gray-700">From adhesives and cements to curing lights and tools, we use dental consumables sourced from globally trusted brands like Ivoclar Vivadent (Europe), 3M, Kerr, and DENTSPLY (USA). This ensures long-lasting, high-quality results in every treatment.</p>
            </div>
        </div>
    </div>
</section>
@endsection
