 <section id="about" class="py-24">
     <div class="container mx-auto px-6">
         <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
             <div class="relative">
                 <img src="https://media.realigndental.com/assets/images/about/about.jpg"
                     onerror="this.onerror=null; this.src='{{ asset('images/about/about.jpg') }}';"
                     class="rounded-lg shadow-lg w-full" alt="About Our Clinic" />
             </div>
             <div>
                 <h2 class="text-4xl font-bold mb-6 text-primary">About Our Clinic</h2>
                 <p class="text-gray-600 mb-8">
                     Welcome to Realign Dental Clinic, where we combine advanced
                     technology with compassionate care to deliver exceptional dental
                     services. Our state-of-the-art facility is designed to provide you
                     with the most comfortable and efficient dental experience
                     possible.
                 </p>
                 <div class="grid grid-cols-2 gap-6 mb-10">
                     @foreach ($features as $feature)
                         <div class="flex items-center space-x-3">
                             <div class="w-12 h-12 flex items-center justify-center bg-[teal] rounded-full text-white">
                                 @if ($feature?->icon?->icon)
                                     {!! $feature?->icon?->icon !!}
                                 @else
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                         <path fill-rule="evenodd"
                                             d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                     </svg>
                                 @endif
                             </div>
                             <div>
                                 <h3 class="font-bold">{{ $feature->title }}</h3>
                                 <p class="text-gray-600 text-sm">
                                     {{ $feature->description }}
                                 </p>
                             </div>
                         </div>
                     @endforeach
                 </div>
                 <a href="{{ route('public.about') }}"
                     class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                     Learn More About Us
                 </a>
             </div>
         </div>
     </div>
 </section>
