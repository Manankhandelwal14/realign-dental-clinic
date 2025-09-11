@props(['rating' => 0, 'content' => 'review', 'name' => 'name', 'date' => '1 month ago'])

<div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-all">
    <div class="flex text-yellow-400 mb-4 gap-1">
        @for ($i = 0; $i < $rating; $i++)
            <x-icons.star class="w-5" />
        @endfor
    </div>
    <p class="text-gray-600 mb-6 line-clamp-4s">{{ $content }}</p>
    <div class="flex items-center mt-2">
        <img src="https://public.readdy.ai/ai/img_res/2e2f07d0e409aee9ab84a14a66d3fb55.jpg"
            class="w-12 h-12 rounded-full mr-4" alt="Rebecca Thompson" />
        <div>
            <h4 class="font-semibold">{{ $name }}</h4>
            <p class="text-gray-600 text-sm">
                {{ $date }}
            </p>
        </div>
    </div>
</div>
