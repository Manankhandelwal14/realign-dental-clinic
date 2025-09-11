@extends('layouts.public.app')

@section('content')
    <div class="container px-5 md:px-16 py-12 md:max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2 text-[teal]">
                Request Callback
            </h1>
            <p class="text-gray-600">Fill the form below to request an instant callback from our dental experts.</p>
        </div>
        <form id="appointmentForm" class="space-y-6" action="{{ route('public.callback-request.store') }}" method="POST">
            @csrf
            <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6 space-y-6">
                <div class="space-y-4">
                    <div>
                        <x-label for="name" class="!text-gray-600">Full Name</x-label>
                        <x-input type="text" id="name" name="name"
                            class="w-full py-2 px-2 border border-gray-300" placeholder="Enter your full name" required />
                        <x-input-error for="name" />
                    </div>
                    <div>
                        <div>
                            <x-label for="phone" class="!text-gray-600">Mobile Number</x-label>
                            <div class="flex items-center">
                                <label class="bg-gray-300 p-[9px] rounded-l-md outline-none">+91</label>
                                <x-input type="tel" id="phone" name="phone"
                                    class="w-full rounded-l-none py-2 border border-gray-300 px-2" required />
                            </div>
                            <x-input-error for="phone" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <x-label for="time" class="!text-gray-600">Time (Which time you want to get a
                                callback)</x-label>
                            <x-input type="time" id="time" name="time"
                                class="w-full border border-gray-300 py-2 px-2" />
                            <p class="text-gray-500 text-sm">You can request a callback between 9:00 AM to 6:00 PM</p>
                        </div>
                        <x-input-error for="time" />
                    </div>
                </div>
                {{-- term and condition --}}
                <div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="terms" name="terms" required
                            class="rounded-md text-[teal] focus:ring-[teal] focus:ring-1 focus:ring-offset-1 focus:ring-offset-white focus:ring-opacity-60 focus:ring-offset-opacity-20 focus:outline-none h-4 w-4" />
                        <label for="terms" class="text-gray-600">I agree to the
                            <a href="{{ route('public.terms') }}" class="text-[teal]">terms and conditions</a>
                            and <a href="{{ route('public.privacy-policy') }}" class="text-[teal]">Privacy Policy</a>
                        </label>
                    </div>
                    <x-input-error for="terms" />
                </div>
                <x-button type="submit"
                    class="w-full !bg-[teal] !hover:bg-[teal]/80 !text-white py-3 flex items-center justify-center">
                    Request Instant Callback
                </x-button>
            </div>
        </form>
    </div>
    @if (session('success'))
        <div class="fixed inset-0 flex items-center justify-center bg-black/60 z-50" id="success-modal">
            <div
                class="backdrop-blur-md py-5 bg-white/90 border border-white/20 text-dark rounded-lg shadow-lg p-6 max-w-md w-full text-center relative modal">

                <h2 class="text-2xl font-bold mb-2">Thank you!</h2>
                <p class="text-gray-700 mb-4">Our dentist will contact you as soon as possible.</p>
                <button onclick="toggleSuccessModal()"
                    class="bg-[teal] text-white font-bold py-2 px-6 rounded-lg hover:bg-[teal]/80 transition">
                    Close
                </button>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        function toggleSuccessModal() {
            document.getElementById('success-modal').classList.toggle('hidden');
        }
    </script>
@endpush
