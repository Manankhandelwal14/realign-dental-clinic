<div class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-5xl font-light mb-8 text-gold">Recent Articles</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach ($articles as $article)
            <a href="{{ route('public.article.show', $article->slug) }}">
                <article
                    class="flex flex-col space-y-4 border p-4 rounded-lg group hover:border-gold hover:transform hover:-translate-y-1 transition-transform cursor-pointer">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo/logo-small-png.png') }}" alt="ReAlign Dental Clinic"
                            class="w-12 h-12 rounded-full border p-2 group-hover:border-gold">
                        <div class="flex flex-col">
                            <span class="font-medium capitalize group-hover:text-gold">Realign Dental Clinic</span>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    2
                                </span>
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="bi bi-clock w-3 h-3 mr-1" viewBox="0 0 16 16">
                                        <path
                                            d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                    </svg>
                                    <time>October 21, 2019</time>
                                </span>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-xl font-serif leading-tight transition-colors group-hover:text-gold">Tooth
                        extraction
                        aftercare: A how-to guide</h3>
                    <p class="text-gray-600 line-clamp-2">Tooth extraction involves completely removing a tooth from the
                        mouth.
                        People may require tooth extractio...</p>
                </article>
            </a>
        @endforeach
    </div>
</div>
