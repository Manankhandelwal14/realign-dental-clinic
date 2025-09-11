 <section id="services" class="py-24 bg-gray-50">
     <div class="container mx-auto px-6">
         <div class="text-center mb-16">
             <h2 class="text-4xl font-bold mb-4 text-primary">Our Treatments</h2>
             <p class="text-gray-600 max-w-2xl mx-auto">
                 We offer a comprehensive range of dental services to meet all your
                 oral health needs
             </p>
         </div>
         <div class="grid grid-cols-1 md:grid-cols-3 xxl:grid-cols-4 gap-8">
             @foreach ($services as $service)
                 <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-all">
                     <div class="w-14 h-14 flex items-center justify-center bg-[teal]/40 rounded-full mb-6 bg-center bg-cover bg-no-repeat"
                         style="background-image: url('{{ $service->getFirstMediaUrl('images', 'thumb') }}')">
                         <i class="ri-tooth-line text-primary text-2xl"></i>
                     </div>
                     <h3 class="text-xl font-semibold mb-4">
                         {{ $service->name }}
                     </h3>
                     <p class="text-gray-600 mb-4">
                         {{ $service->sort_description }}
                     </p>
                     <a href="#" class="text-primary font-semibold hover:text-primary/80">Learn More →</a>
                 </div>
             @endforeach
         </div>
         <div class="flex justify-center mt-12">
             <a href="{{ route('public.services') }}"
                 class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                 View All Reviews
             </a>
         </div>
     </div>
 </section>
