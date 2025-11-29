<article class="group bg-white rounded-3xl border border-slate-100 shadow-sm 
                hover:shadow-md transition-all duration-300 overflow-hidden">

    <div class="p-6 sm:p-8">

        {{-- USER HEADER --}}
        <div class="flex items-center gap-4 mb-6">
            <img class="h-11 w-11 rounded-full object-cover ring-2 ring-white shadow"
                 src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random&color=fff"
                 alt="{{ $post->user->name }}'s avatar">

            <div>
                <p class="font-semibold text-slate-900 text-sm">
                    {{ $post->user->name }}
                </p>
                <p class="text-xs text-slate-500">
                    {{ $post->created_at->format('j M Y') }} · 
                    <span class="text-slate-400">{{ $post->created_at->diffForHumans() }}</span>
                </p>
            </div>
        </div>

        {{-- TITLE + CONTENT --}}
        <div class="pl-14">
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 mb-2 leading-tight
                       group-hover:text-teal-600 transition">
                {{ $post->title }}
            </h2>

            <p class="text-slate-700 text-sm md:text-base mb-5 line-clamp-3 leading-relaxed">
                {{ $post->content }}
            </p>
        </div>

        {{-- BOTTOM AREA --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 gap-4">

            {{-- Room Info --}}
            <div>
                <p class="text-xs font-medium text-slate-500 mb-1">
                    Mengundang ke Room
                </p>

                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                 bg-indigo-50 text-indigo-600 border border-indigo-100">
                        {{ $post->room->roomType->name }}
                    </span>

                    <span class="font-semibold text-slate-800 text-sm">
                        {{ $post->room->title }}
                    </span>
                </div>
            </div>

            {{-- Button --}}
            <a href="{{ route('explore.room.show', $post->room) }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full
                      bg-teal-500 text-white text-sm font-semibold 
                      hover:bg-teal-600 transition shadow-sm hover:shadow-md
                      focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2">
                
                <span>Lihat Detail Room</span>

                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7" />
                </svg>
            </a>

        </div>

    </div>
</article>
