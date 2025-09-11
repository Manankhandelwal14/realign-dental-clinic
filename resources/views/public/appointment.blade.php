@extends('layouts.public.app')

@section('content')
    <div class="container px-5 md:px-16 py-12 md:max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2 text-[teal]">
                Book Your Appointment
            </h1>
            <p class="text-gray-600">Schedule your appointment with our top-rated dentists</p>
        </div>
        <x-validation-errors />
        <form id="appointmentForm" class="space-y-6" action="{{ route('public.appointment.store') }}" method="POST">
            @csrf
            <div class="bg-white rounded-lg shadow-sm border !border-gray-300 p-6 space-y-6">
                <div class="space-y-4">
                    <div>
                        <x-label for="name" class="!text-gray-700">Full Name</x-label>
                        <x-input type="text" id="name" name="name" required
                            class="w-full py-2 border border-gray-400 px-3" value="{{ old('name') }}" />
                        <x-input-error for="name" />
                    </div>
                    <div>
                        <x-label for="phone" class="!text-gray-700">Mobile Number</x-label>
                        <div>
                            <div class="flex items-center">
                                <label class="bg-gray-300 p-[9px] rounded-l-md outline-none">+91</label>
                                <x-input type="tel" id="phone" required name="phone"
                                    class="w-full rounded-l-none py-2 border border-gray-400 rounded-r-md px-3"
                                    value="{{ old('phone') }}" />
                            </div>
                            <x-input-error for="phone" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-label for="date" class="!text-gray-700">Preferred Date</x-label>
                            <x-input type="date" id="date" name="date"
                                class="w-full py-2 border border-gray-400 px-3" value="{{ old('date') }}" required />
                            <x-input-error for="date" />
                        </div>
                        <div>
                            <x-label for="time" class="!text-gray-700">Preferred Time</x-label>
                            <x-input type="time" id="time" name="time"
                                class="w-full border border-gray-400 py-2 px-3" required value="{{ old('time') }}" />
                            <x-input-error for="time" />
                        </div>
                    </div>
                    <div>
                        <x-label for="problem_description" class="!text-gray-700">Describe Your Problem</x-label>
                        <x-textarea id="problem_description" name="problem_description"
                            class="w-full border !border-gray-400 py-2 px-3 !bg-white !text-gray-900">
                            {{ old('problem_description') }}
                        </x-textarea>
                        <x-input-error for="problem_description" />
                    </div>
                </div>
                <x-button type="submit"
                    class="w-full !bg-[teal] !hover:bg-[teal]/80 py-3 !text-white flex items-center justify-center">
                    Book Appointment
                </x-button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="fixed inset-0 flex items-center justify-center bg-black/60 z-50" id="success-modal">
            <div
                class="backdrop-blur-md py-5 bg-white/90 border border-white/20 text-dark rounded-lg shadow-lg p-6 max-w-md w-full text-center relative modal">

                <h2 class="text-2xl font-bold mb-2">Thank you!</h2>
                <p class="text-gray-700 mb-4">
                    {{ session('success') }}
                </p>
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
