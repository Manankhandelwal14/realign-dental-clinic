<section class="py-24">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Our Locations</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Find the Realign Dental Clinic nearest to you
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @foreach ($branches as $branch)
                <a href="{{ route('public.branch.show', $branch->slug) }}"
                    class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-all text-center transform hover:-translate-y-2">
                    <h3 class="text-xl font-semibold mb-2">
                        {{ $branch->name }}
                    </h3>
                    <div class="space-y-3 text-gray-600">
                        <p class="text-gray-600">
                            {{ $contact?->street }},<br>
                            {{ $contact?->city }}, {{ $contact?->state }} {{ $contact?->pincode }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
