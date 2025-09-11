 <section id="contact" class="py-20">
     <div class="container mx-auto px-4">
         <div class="grid md:grid-cols-2 gap-12">
             <div>
                 <h2 class="text-4xl font-bold mb-8 text-[teal]">Contact Us</h2>
                 <div class="space-y-6">
                     <div class="flex items-start space-x-4">
                         <div class="w-12 h-12 flex items-center justify-center bg-[teal]/40 rounded-full flex-shrink-0">
                             <x-icons.location />
                         </div>
                         <div>
                             <h3 class="font-bold mb-2">Location</h3>
                             <p class="text-gray-600">
                                 {{ $contact?->street }},<br>
                                 {{ $contact?->city }}, {{ $contact?->state }} {{ $contact?->pincode }}
                             </p>
                         </div>
                     </div>
                     <div class="flex items-start space-x-4">
                         <div
                             class="w-12 h-12 flex items-center justify-center bg-[teal]/40 rounded-full flex-shrink-0">
                             <x-icons.calendar />
                         </div>
                         <div>
                             <h3 class="font-bold mb-2">Working Hours</h3>
                             <p class="text-gray-600">
                                 Monday - Sunday: 9:00 AM to 2:00 PM or<br /> 4:00 PM to 8:00 PM
                             </p>
                         </div>
                     </div>
                     <div class="flex items-start space-x-4">
                         <div
                             class="w-12 h-12 flex items-center justify-center bg-[teal]/40 rounded-full flex-shrink-0">
                             <x-icons.contact />
                         </div>
                         <div>
                             <h3 class="font-bold mb-2">Contact</h3>
                             <p class="text-gray-600">
                                 Phone: {{ $contact->phone }}<br>
                                 Email: {{ $contact->email }}
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
             <div>
                 <div class="bg-gray-800 rounded-lg overflow-hidden h-[450px] border border-gray-700">
                     <iframe title="Google Map" src="{{ $contact?->google_map_iframe }}" width="100%" height="450"
                         style="border:0;" allowfullscreen="" loading="lazy" aria-controls="contact"
                         referrerpolicy="no-referrer-when-downgrade"></iframe>
                 </div>
             </div>
         </div>
     </div>
 </section>
