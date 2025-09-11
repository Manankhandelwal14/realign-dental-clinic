<section id="team" class="py-24 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-primary">Meet Our Team</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Our experienced team of dental professionals is dedicated to
                providing you with the best care possible
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($teams as $member)
                <div
                    class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all w-80 mx-auto transform hover:-translate-y-2">
                    <img src="{{ $member->getFirstMediaUrl('profile') }}" class="w-full h-64 object-cover"
                        alt="{{ $member->name }}" />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-primary">
                            {{ $member->name }}
                        </h3>
                        <p class="text-gray-600 mb-4 text-xs">
                            {{ $member->designation }}
                        </p>
                        <div class="flex space-x-4 justify-between items-center">
                            <div>
                                @foreach ($member->social_media as $key => $value)
                                    <a href="{{ $value }}" class="text-gray-400 hover:text-primary">
                                        @if (Str::lower($key) === 'facebook')
                                            <x-icons.facebook class="w-6" />
                                        @endif
                                        @if (Str::lower($key) === 'twitter')
                                            <x-icons.twitter class="w-6" />
                                        @endif
                                        @if (Str::lower($key) === 'instagram')
                                            <x-icons.instagram class="w-6" />
                                        @endif
                                        @if (Str::lower($key) === 'linkedin')
                                            <x-icons.linkedin class="w-6" />
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                            <a href="{{ route('public.doctor.show', $member->slug) }}"
                                class="bg-[teal] text-white px-4 py-2 rounded-full text-xs font-semibold hover:bg-[teal]/90 transition-all">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
