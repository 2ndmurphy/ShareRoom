<article class="bg-white shadow-md rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg">
    <div class="p-6 sm:p-8">
        <div class="flex items-center mb-4">
            <img class="h-10 w-10 rounded-full object-cover mr-3" 
                 src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random&color=fff" 
                 alt="{{ $post->user->name }}'s avatar">
            <div>
                <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>

        <div class="ml-13"> <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                {{ $post->title }}
            </h2>
            
            <p class="text-gray-700 mb-5 line-clamp-3">
                {{ $post->content }}
            </p>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mt-5">
            <div class="mb-4 sm:mb-0">
                {{-- <span class="text-sm text-gray-600">Mengundang ke Room:</span> --}}
                <div class="flex items-center mt-1">
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium
                                 bg-indigo-100 text-indigo-800 mr-2">
                        {{ $post->room->roomType->name }}
                    </span>
                    {{-- <span class="font-semibold text-gray-800">{{ $post->room->title }}</span> --}}
                </div>
            </div>

            <a href="{{ route('explore.room.show', $post->room) }}" 
               class="inline-block text-center px-5 py-2 bg-indigo-600 text-white rounded-lg
                      hover:bg-indigo-700 transition duration-300 shadow-md
                      hover:shadow-lg focus:outline-none focus:ring-2
                      focus:ring-indigo-500 focus:ring-opacity-50">
                Lihat Detail Room
            </a>
        </div>
    </div>
</article>