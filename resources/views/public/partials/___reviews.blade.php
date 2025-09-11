<section id="services" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Our Patients, Our Pride</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Authentic stories of care, trust, and transformation. Join the
                family of happy, healthy smiles today!</p>
        </div>
        <div class="grid md:grid-cols-4 gap-8">
            @foreach ($reviews as $review)
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4 gap-1">
                        @for ($i = 0; $i < $review->rating; $i++)
                            <x-icons.star class="text-primary h-5 w-5" />
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-2 italic">"{{ $review->caption }}"</p>
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h4 class="font-semibold">- {{ $review->name }}</h4>
                            <p class="text-sm text-gray-500">
                                {{ $review->date->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
