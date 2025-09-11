@if ($teams->count())
    <section id="team" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Meet Our Doctors</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Our team of experienced dental professionals is
                    dedicated to providing you with the highest quality care.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($teams as $member)
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="relative">
                            <img src="{{ $member->getFirstMediaUrl('profile') }}" alt="{{ $member->name }}"
                                class="w-full h-[400px] object-cover">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                                <h3 class="text-white text-xl font-bold">
                                    {{ $member->name }}
                                </h3>
                                <p class="text-white/80">
                                    {{ $member->designation }}
                                </p>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Specializing in cosmetic dentistry with over 15 years of
                                experience in creating beautiful smiles.</p>
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-4">
                                    <a href="#"
                                        class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full hover:bg-[teal]/40 transition-colors">
                                        <x-icons.facebook class="text-primary" />
                                    </a>
                                    <a href="#"
                                        class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full hover:bg-[teal]/40 transition-colors">
                                        <x-icons.twitter class="text-primary" />
                                    </a>
                                    <a href="#"
                                        class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full hover:bg-[teal]/40 transition-colors">
                                        <x-icons.linkedin class="text-primary" />
                                    </a>
                                    <a href="#"
                                        class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full hover:bg-[teal]/40 transition-colors">
                                        <x-icons.instagram class="text-primary" />
                                    </a>
                                </div>
                                <a href="{{ route('public.doctor.show', $member->slug) }}"
                                    class="text-primary hover:text-primary/80 font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
