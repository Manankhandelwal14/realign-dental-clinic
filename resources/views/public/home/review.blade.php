 <section class="py-24">
     <div class="container mx-auto px-6">
         <div class="text-center mb-16">
             <h2 class="text-4xl font-bold mb-4">Patient Testimonials</h2>
             <p class="text-gray-600 max-w-2xl mx-auto">
                 See what our patients have to say about their experience at Realign
                 Dental Clinic
             </p>
         </div>
         <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
             @foreach ($reviews as $review)
                 <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-all border border-gray-200">
                     <div class="flex text-yellow-400 mb-4 gap-1">
                         @for ($i = 0; $i < $review->rating; $i++)
                             <x-icons.star class="w-5" />
                         @endfor
                     </div>
                     <div class="mb-6">
                         <p class="text-gray-600 line-clamp-4s line-clamp-4">{!! $review?->content !!}</p>
                         <a href="{{ route('public.review.show', $review) }}" class="text-blue-500 hover:underline">Read
                             more</a>
                     </div>
                     <div class="flex items-center mt-2">
                         <img src="https://ui-avatars.com/api/?name={{ $review?->author }}&color=7F9CF5&background=EBF4FF"
                             class="w-12 h-12 rounded-full mr-4" alt="Rebecca Thompson" />
                         <div>
                             <h4 class="font-semibold">
                                 {{ $review->author }}
                             </h4>
                             <p class="text-gray-600 text-sm">
                                 {{ $review?->date?->diffForHumans() }}
                             </p>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
         {{-- view all --}}
         @if ($reviews->count() > 3)
             <div class="flex justify-center mt-12">
                 <a href="{{ route('public.reviews') }}"
                     class="bg-[teal] text-white px-8 py-3 rounded hover:bg-[teal]/90 transition-colors whitespace-nowrap">
                     View All Reviews
                 </a>
             </div>
         @endif
     </div>
 </section>
