@extends('layouts.public.app')

@section('content')
    <section class="relative h-[300px] bg-cover bg-center"
        style="background-image: url('https://public.readdy.ai/ai/img_res/645e7f0013435a5a5381f54b17605bca.jpg')">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="container mx-auto px-4 h-full flex items-center relative">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold mb-6">Our Branches</h1>
                <p class="text-xl mb-8">Visit our branches in major cities around the world. Our state-of-the-art facilities
                    are designed to provide you with the best dental care.</p>
            </div>
        </div>
    </section>
    <div class="container mx-auto px-4 py-8 mt-16">
        <div class="flex flex-wrap justify-start items-center max-w-5xl m-auto gap-14">
            @foreach ($branches as $branch)
                <a href="{{ route('public.branch.show', $branch->slug) }}">
                    <div class="branch-card flex-none w-40 group cursor-pointer">
                        <div class="w-40 h-40 rounded-full overflow-hidden">
                            <img src="{{ $branch->getFirstMediaUrl('banner') }}"
                                class="object-cover shadow-lg group-hover:scale-125 transition-transform"
                                alt="New York Branch" />
                        </div>
                        <div class="mt-2 text-center">
                            <h3 class="text-sm font-semibold text-gray-900">
                                {{ $branch->district }}, {{ $branch->state }}
                            </h3>
                            <p class="text-xs text-gray-600">
                                {{ $branch->address }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
