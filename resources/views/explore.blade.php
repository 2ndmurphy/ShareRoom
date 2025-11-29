<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-2">
                    <div class="space-y-6">
                        
                        @forelse ($posts as $post)
                            @include('partials._post-card', ['post' => $post])
                        @empty
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 text-center">
                                    <h3 class="text-lg font-medium">Belum Ada Undangan</h3>
                                    <p class="text-gray-500 mt-2">
                                        Saat ini belum ada mentor yang mempublikasikan undangan room baru.
                                    </p>
                                </div>
                            </div>
                        @endforelse

                        <div class="mt-8">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>

                <aside class="md:col-span-1 space-y-6">
                    
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Tipe Room
                        </h3>
                        <ul class="space-y-2">
                            @isset($roomTypes)
                                @foreach($roomTypes as $type)
                                    <li>
                                        <a href="#" class="flex items-center text-gray-700 hover:text-indigo-600 group">
                                            <span class="w-2 h-2 rounded-full bg-indigo-500 mr-3"></span>
                                            <span class="group-hover:font-semibold">{{ $type->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Mentor Populer
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-10 w-10 rounded-full object-cover mr-3" src="https://placehold.co/60x60" alt="Avatar">
                                <span class="text-gray-700 font-medium">Mentor A</span>
                            </li>
                            <li class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-10 w-10 rounded-full object-cover mr-3" src="https://placehold.co/60x60" alt="Avatar">
                                <span class="text-gray-700 font-medium">Mentor B</span>
                            </li>
                        </ul>
                    </div>
                    
                </aside>
                
            </div>
        </div>
    </div>
</x-app-layout>