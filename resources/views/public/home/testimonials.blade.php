  <section class="py-16">
      <div class="container mx-auto px-4">
          <h2 class="text-3xl md:text-3xl font-bold text-gray-700 mb-2 text-center">Hear from those who’ve smiled
              with
              us!
          </h2>
          <p class="text-lg text-gray-600 mb-8 text-center m-auto">
              See what our patients love about us – heartfelt stories that inspire confidence, trust, and the
              brightest
              smiles!
          </p>
          <div class="grid grid-cols-1 md:grid-cols-3 mt-10 gap-10">
              @foreach ($testimonials as $key => $testimonial)
                  <div class="bg-white  overflow-hidden shadow-md sm:rounded-lg video-card"
                      videoId="{{ $testimonial->id }}">
                      @if ($testimonial->getFirstMediaUrl('video'))
                          <div class="rounded-t-lg overflow-hidden relative group">
                              {{-- auto play $key 1 --}}
                              <video loop muted class="w-full h-[27rem] object-cover" id="video-{{ $testimonial->id }}"
                                  {{-- {{ $key == 1 ? 'autoplay' : '' }} --}} poster="{{ $testimonial->getFirstMediaUrl('poster') }}"
                                  preload="metadata">
                                  <source src="{{ $testimonial->getFirstMediaUrl('video') }}" type="video/mp4">
                                  Your browser does not support the video tag.
                              </video>
                              <div class="absolute top-0 right-0 m-2 flex space-x-2"
                                  id="controls-{{ $testimonial->id }}">
                                  <button id="mute-btn-{{ $testimonial->id }}"
                                      class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-opacity-50"
                                      onclick="toggleMute('{{ $testimonial->id }}')">
                                      <x-icons.mute />
                                  </button>
                              </div>
                              <div
                                  class="absolute -bottom-1 group-hover:bottom-0 left-0 w-full h-1 bg-gray-800 border-t border-gray-800">
                                  <div id="progress-{{ $testimonial->id }}" class="h-full rounded-r-full bg-white"
                                      style="width: 0%;"></div>
                              </div>
                          </div>
                      @endif
                      <div class="p-3 border-t border-gray-800 dark:border-gray-700 dark">
                          <p class="text-sm italic text-gray-800 capitalize">
                              "{{ $testimonial->caption }}"
                          </p>
                          <div class="flex items-center mt-2">
                              <img src="https://ui-avatars.com/api/?name={{ $testimonial->author }}&color=7F9CF5&background=EBF4FF"
                                  alt="{{ $testimonial->author }}" class="w-8 h-8 rounded-full object-cover"
                                  loading="lazy">
                              <div class="ml-2">
                                  <h6 class="font-semibold text-sm">{{ $testimonial->author }}</h6>
                                  <p class="text-xs text-gray-500">
                                      {{ $testimonial->created_at->diffForHumans() }}
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </section>
