 @push('styles')
     <style>

     </style>
 @endpush

 <section id="before-after" class="py-20">
     <div class="container mx-auto px-4">
         <div class="text-center mb-16">
             <h2 class="text-4xl font-bold text-primary mb-4">Before & After</h2>
             <p class="text-gray-600 max-w-2xl mx-auto">See the amazing transformations we've achieved for our
                 patients through our expert dental care.</p>
         </div>
         @forelse ($before_afters as $key=>$before_after)
             <div class="grid md:grid-cols-2 gap-12 items-center mb-10">
                 <div class="relative @if ($key % 2 != 0) md:order-1 @endif ">
                     <div id="after-before-container" aria-label="Before and after image slider"
                         class="rounded-lg overflow-hidden m-auto">
                         <div class="img-wrapper">
                             <img src="{{ $before_after->getFirstMediaUrl('before_image') }}"
                                 onerror="this.onerror=null; this.src='{{ asset('images/before_after/1.webp') }}';"
                                 alt="Before" loading="lazy">
                         </div>
                         <div class="img-wrapper">
                             <img src="{{ $before_after->getFirstMediaUrl('after_image') }}"
                                 onerror="this.onerror=null; this.src='{{ asset('images/before_after/2.webp') }}';"
                                 alt="After" loading="lazy">
                         </div>
                         <div id="line"></div>
                         <input id="slider" type="range" min="0" max="100" value="50">
                     </div>
                 </div>
                 <div class="@if ($key % 2 == 0) md:order-2 @endif">
                     <h3 class="text-2xl font-bold mb-6">
                         {{ $before_after->title }}
                     </h3>
                     <div class="editor-content">
                         {!! $before_after->description !!}
                     </div>
                     <div class="mt-8">
                         <a href="{{ route('public.appointment') }}"
                             class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                             Schedule Consultation
                         </a>
                     </div>
                 </div>
             </div>
         @empty
             <div class="grid md:grid-cols-2 gap-12 items-center">
                 <div class="relative">
                     <div id="after-before-container" aria-label="Before and after image slider"
                         class="rounded-lg overflow-hidden m-auto">
                         <div class="img-wrapper">
                             <img src="https://media.realigndental.com/assets/images/before_after/1.webp"
                                 onerror="this.onerror=null; this.src='{{ asset('images/before_after/1.webp') }}';"
                                 alt="Before" loading="lazy">
                         </div>
                         <div class="img-wrapper">
                             <img src="https://media.realigndental.com/assets/images/before_after/2.webp"
                                 onerror="this.onerror=null; this.src='{{ asset('images/before_after/2.webp') }}';"
                                 alt="After" loading="lazy">
                         </div>
                         <div id="line"></div>
                         <input id="slider" type="range" min="0" max="100" value="50">
                     </div>
                 </div>
                 <div>
                     <h3 class="text-2xl font-bold mb-6">Complete Smile Makeover</h3>
                     <p class="text-gray-600 mb-6">This patient underwent a comprehensive smile transformation that
                         included:</p>
                     <ul class="space-y-4">
                         <li class="flex items-start space-x-3">
                             <div
                                 class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/40 rounded-full">
                                 <x-icons.check class="text-[teal]" />
                             </div>
                             <span class="text-gray-600">Professional teeth whitening for a brighter smile</span>
                         </li>
                         <li class="flex items-start space-x-3">
                             <div
                                 class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/40 rounded-full">
                                 <x-icons.check class="text-[teal]" />
                             </div>
                             <span class="text-gray-600">Porcelain veneers for perfect shape and alignment</span>
                         </li>
                         <li class="flex items-start space-x-3">
                             <div
                                 class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/40 rounded-full">
                                 <x-icons.check class="text-[teal]" />
                             </div>
                             <span class="text-gray-600">Gum contouring for improved aesthetics</span>
                         </li>
                         <li class="flex items-start space-x-3">
                             <div
                                 class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[teal]/40 rounded-full">
                                 <x-icons.check class="text-[teal]" />
                             </div>
                             <span class="text-gray-600">Dental crowns for damaged teeth restoration</span>
                         </li>
                     </ul>
                     <div class="mt-8">
                         <p class="text-gray-600 mb-6">Treatment Duration: 3 months<br>Patient Satisfaction:
                             Extremely Happy</p>
                         <a href="{{ route('public.appointment') }}"
                             class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                             Schedule Consultation
                         </a>
                     </div>
                 </div>
             </div>
         @endforelse
     </div>
 </section>
