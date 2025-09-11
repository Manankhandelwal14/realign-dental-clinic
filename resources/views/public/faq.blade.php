@extends('layouts.public.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-[teal] mb-2">
                Frequently Asked Questions
            </h1>
            <p class="text-lg text-gray-600">
                Find answers to common questions about our dental services,
                procedures, and policies. Can't find what you're looking for? Feel
                free to contact us.
            </p>
        </div>
        <div class="relative mb-5">
            <div class="flex items-center h-14 relative">
                <x-input type="text" placeholder="Search your question here..."
                    class="w-full py-3 !bg-white ps-12 border !border-gray-400 text-gray-600" />
                <div class="absolute left-4 w-5 h-5 flex items-center justify-center text-gray-400">
                    <x-icons.search />
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-3 mb-12">
            @foreach ($faqs as $faq)
                <div class="faq-item bg-white border rounded-lg shadow-sm overflow-hidden">
                    <button
                        class="w-full px-6 py-4 text-left border-b flex justify-between items-center hover:bg-gray-50 transition-colors">
                        <span class="font-medium text-[teal]">
                            {{ $faq->question }}
                        </span>
                        <span class="icon-plus text-gray-400">+</span>
                        <span class="icon-minus text-gray-400 hidden">-</span>
                    </button>
                    <div class="answer px-6 py-4 text-gray-600 bg-gray-50 hidden">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">
                Still have questions?
            </h3>
            <p class="text-gray-600 mb-6">
                Our friendly team is here to help you with any specific questions or
                concerns.
            </p>
            <div class="flex justify-center gap-4">
                <button
                    class="rounded bg-[teal] text-white px-6 py-3 font-medium hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                    Contact Us
                </button>
                <button
                    class="rounded bg-white text-[teal] border border-[teal] px-6 py-3 font-medium hover:bg-[teal]/5 transition-colors whitespace-nowrap">
                    Book Appointment
                </button>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".faq-item button").forEach((button) => {
                button.addEventListener("click", () => {
                    const faqItem = button.closest(".faq-item");
                    const answer = faqItem.querySelector(".answer");
                    const iconPlus = button.querySelector(".icon-plus");
                    const iconMinus = button.querySelector(".icon-minus");

                    answer.classList.toggle("hidden");
                    iconPlus.classList.toggle("hidden");
                    iconMinus.classList.toggle("hidden");
                });
            });

            const searchInput = document.querySelector('input[type="text"]');
            searchInput.addEventListener("input", (e) => {
                const searchTerm = e.target.value.toLowerCase();
                document.querySelectorAll(".faq-item").forEach((item) => {
                    const question = item
                        .querySelector("button span")
                        .textContent.toLowerCase();
                    const answer = item.querySelector(".answer").textContent.toLowerCase();
                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    </script>
@endpush
