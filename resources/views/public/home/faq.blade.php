 <section class="py-24 bg-gray-50">
     <div class="container mx-auto px-6">
         <div class="text-center mb-16">
             <h2 class="text-4xl font-bold mb-4 text-primary">Frequently Asked Questions</h2>
             <p class="text-gray-600 max-w-2xl mx-auto">
                 Find answers to common questions about our dental services, procedures, and policies. Can't find what
                 you're looking for? Feel free to contact us.
             </p>
         </div>
         <div class="max-w-3xl mx-auto space-y-4">
             @foreach ($faqs as $faq)
                 <div class="bg-white rounded-lg shadow-sm">
                     <button class="w-full text-left p-6 focus:outline-none faq-toggle">
                         <div class="flex justify-between items-center">
                             <h3 class="text-sm font-semibold">
                                 {{ $faq->question }}
                             </h3>
                             <x-icons.plus />
                         </div>
                     </button>
                     <div class="hidden p-6 pt-0 faq-content">
                         <p class="text-gray-600">
                             {!! $faq->answer !!}
                         </p>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>



 @push('scripts')
     <script>
         const faqToggles = document.querySelectorAll(".faq-toggle");
         faqToggles.forEach((toggle) => {
             toggle.addEventListener("click", () => {
                 const content = toggle.nextElementSibling;
                 toggle.querySelector("svg").classList.toggle("rotate-45");
                 content.classList.toggle("hidden");
             });
         });
     </script>
 @endpush
