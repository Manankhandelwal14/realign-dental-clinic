@extends('layouts.public.app')
@section('content')
<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h1 class="text-3xl font-bold mb-4 text-[teal]">Our Quality Commitment</h1>
            <p class="text-gray-700">At Realign Dental, quality is not just a standard—it’s a culture. Our dedicated Quality Team ensures that every clinic adheres to the highest clinical and safety protocols. Through ongoing audits, training, and data-driven improvements, we are committed to delivering consistent, world-class dental care.</p>
        </div>

        {{-- Protocol Standardization --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Standardized Policies & Safety Protocols</h2>
                <p class="text-gray-700">All Realign Dental clinics operate under unified clinical and hygiene protocols to ensure 100% sterile environments. Our updated 10X Safety Protocols are designed to offer exceptional protection for patients, doctors, and attendants in a post-pandemic world.</p>
            </div>
        </div>

        {{-- Surprise Quality Audits --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Surprise Audits & Mock Drills</h2>
                <p class="text-gray-700">Each clinic undergoes bi-monthly surprise quality audits and mock drills to ensure complete adherence to SOPs. These checks verify proper use of PPE and confirm that all infection control protocols are followed without exception.</p>
            </div>
        </div>

        {{-- Secure Digital Records --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Encrypted Patient Record System</h2>
                <p class="text-gray-700">We maintain a secure, centralized patient record system accessible only by authorized Realign Dental clinicians. This encrypted platform supports billing, peer reviews, and ensures complete confidentiality and continuity of care.</p>
            </div>
        </div>

        {{-- Continuous Training --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Ongoing Staff Training & Clinical Development</h2>
                <p class="text-gray-700">Our dentists and clinical staff regularly undergo intensive training on new treatments, tools, and WHO-compliant infection control standards—ensuring professional excellence and patient safety at all times.</p>
            </div>
        </div>

        {{-- Clinical Analysis & Peer Review --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">In-House Case Analysis Tools</h2>
                <p class="text-gray-700">Our proprietary digital software enables detailed case analysis using structured protocols. It also facilitates peer-review processes under strict confidentiality to uphold treatment quality across all clinics.</p>
            </div>
        </div>

        {{-- Biological Spore Testing --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Microbiological Testing & Infection-Free Certification</h2>
                <p class="text-gray-700">We conduct periodic biological spore testing in partnership with top-rated labs. Swab samples from operatories and sterilization rooms are tested to validate sterility, and each clinic maintains a “Free From Infection” certificate for full transparency.</p>
            </div>
        </div>

        {{-- Radiation Safety --}}
        <div class="flex mb-6 gap-3">
            <x-icons.check class="w-8 h-8 text-green-600" />
            <div>
                <h2 class="text-xl font-bold text-[teal]">Radiation Safety Compliance</h2>
                <p class="text-gray-700">All Realign Dental clinics follow rigorous radiation safety protocols. We use protective gear such as lead aprons and thyroid collars, and radiation exposure is monitored using dosimetry badges verified by BARC-accredited labs.</p>
            </div>
        </div>
    </div>
</section>
@endsection