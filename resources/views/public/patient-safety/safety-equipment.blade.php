@extends('layouts.public.app')
@section('content')
<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-[teal] mb-4">Enhanced Safety Measures at Realign Dental</h1>
            <p class="text-gray-700">In times when safety is more important than ever, Realign Dental remains committed to creating a secure and sterile environment for our patients, doctors, and staff. Dentistry involves close proximity, and that’s why we’ve elevated our hygiene protocols far beyond the norm to ensure your confidence and well-being with every visit.</p>
        </div>

        {{-- Equipment & Air Safety --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-[teal] mb-3">Advanced Safety Equipment</h2>

            <div class="flex mb-4 gap-3">
                <x-icons.check class="w-8 h-8 text-green-600" />
                <div>
                    <h3 class="text-lg font-semibold">Aerosol Suction & Air Purification Units</h3>
                    <p class="text-gray-700">To control airborne contaminants, our clinics are equipped with high-performance aerosol suction units. These systems utilize layered filtration—including cotton, fiber glass, HEPA (H13), and activated carbon filters—to purify the air during dental procedures, ensuring clean air in every operatory.</p>
                </div>
            </div>

            <div class="flex mb-4 gap-3">
                <x-icons.check class="w-8 h-8 text-green-600" />
                <div>
                    <h3 class="text-lg font-semibold">Constant Fumigation Devices</h3>
                    <p class="text-gray-700">We use advanced ultrasonic humidifiers to regularly fumigate our clinics. These devices eliminate microbes such as viruses, bacteria, fungi, protozoa, and spores, in compliance with European Directive LVD 2014/35/EU. They feature multi-fog heads and touchscreen control for optimal disinfection coverage.</p>
                </div>
            </div>
        </div>

        {{-- Disinfection Cabinets --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-[teal] mb-3">Dedicated Disinfection Technologies</h2>

            <div class="flex mb-4 gap-3">
                <x-icons.check class="w-8 h-8 text-green-600" />
                <div>
                    <h3 class="text-lg font-semibold">UV-C Light Sterilization Cabinets</h3>
                    <p class="text-gray-700">All our clinics feature UV-C cabinets (200–280nm wavelength) that eliminate bacterial and viral contaminants. Common items like tubing, currency, and instruments are regularly sterilized here, and sealed pouches are stored safely to maintain sterility until use.</p>
                </div>
            </div>

            <div class="flex mb-4 gap-3">
                <x-icons.check class="w-8 h-8 text-green-600" />
                <div>
                    <h3 class="text-lg font-semibold">Formalin Disinfection Chambers</h3>
                    <p class="text-gray-700">For items that cannot withstand heat sterilization, such as plastic tools, syringes, and impression trays, we use formalin chambers. This method ensures safe sterilization without compromising material integrity. Items sterilized here are strictly used for external contact only.</p>
                </div>
            </div>
        </div>

        {{-- PPE & Hygiene --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-[teal] mb-3">Protective Gear & Infection Control</h2>

            @foreach([
                ['Disposable Gloves', 'New gloves are worn for every patient, and replaced immediately if contaminated during procedures. Hands are thoroughly sanitized before wearing gloves.'],
                ['Face Masks', 'Our team uses N95/KN95 masks or 3-ply surgical masks depending on the procedure. Patients are also provided with masks if they arrive without one.'],
                ['Protective Eyewear', 'Dentists wear protective glasses during procedures that may generate splatter or aerosol. Eyewear is sanitized after each use.'],
                ['Face Shields', 'Used with masks for additional protection from airborne droplets. Face shields are sterilized between uses.'],
                ['Protective Clothing', 'All clinicians wear scrubs throughout the day to prevent cross-contamination. These are cleaned daily.'],
                ['Surgical Gowns', 'No procedures begin without the team donning high-quality surgical gowns, an essential part of our PPE protocol.'],
                ['Disposable Caps', 'Doctors and assistants wear disposable caps to cover hair completely, preventing potential contamination through aerosols.']
            ] as [$title, $desc])
            <div class="flex mb-4 gap-3">
                <x-icons.check class="w-8 h-8 text-green-600" />
                <div>
                    <h3 class="text-lg font-semibold">{{ $title }}</h3>
                    <p class="text-gray-700">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection