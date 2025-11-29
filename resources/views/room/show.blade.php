<!-- INI BUAT LIHAT DETAIL ROOM (Learner) -->
<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <main class="lg:col-span-2">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6 md:p-10">
                            
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                                {{ $room->title }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-3 mb-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $room->roomType->name }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 capitalize">
                                    💻 {{ $room->mode }}
                                </span>
                                @if($room->location)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    📍 {{ $room->location }}
                                </span>
                                @endif
                            </div>

                            <div class="mb-8">
                                @auth
                                    @if ($isMember)
                                        <div class="text-center">
                                            <p class="font-semibold text-green-700 mb-2">Anda sudah tergabung di room ini.</p>
                                            <form action="{{ route('explore.room.leave', $room) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari room ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Keluar dari Room
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <form action="{{ route('explore.room.join', $room) }}" method="POST">
                                            @csrf
                                            <button type="submit" 
                                                    class="w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Gabung Room Ini
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="block w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Login untuk Bergabung
                                    </a>
                                @endauth
                            </div>

                            <div class="prose prose-lg max-w-none text-gray-700">
                                
                                <h2>Deskripsi Room</h2>
                                <p>{{ $room->description }}</p>

                                @if($room->requirements)
                                <h2>Persyaratan</h2>
                                <p>{{ $room->requirements }}</p>
                                @endif

                                <h2>Apa yang akan Anda Pelajari</h2>
                                <p>Ini adalah daftar materi yang akan dibahas di dalam room:</p>
                                
                                <ol class="list-decimal list-inside space-y-3">
                                    @forelse ($room->materials as $material)
                                        <li class="font-medium text-gray-800">
                                            {{ $material->title }}
                                            @if($material->type == 'file') <span title="File">📄</span>
                                            @elseif($material->type == 'link') <span title="Link Eksternal">🔗</span>
                                            @else <span title="Teks/Artikel">📝</span>
                                            @endif
                                        </li>
                                    @empty
                                        <p class="text-gray-500 italic">Mentor belum mempublikasikan materi untuk room ini.</p>
                                    @endforelse
                                </ol>

                            </div>

                        </div>
                    </div>
                </main>

                <aside class="lg:col-span-1 space-y-6">
                    
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <img class="h-14 w-14 rounded-full object-cover mr-4" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode($room->mentor->name) }}&background=random&color=fff" 
                                 alt="{{ $room->mentor->name }}'s avatar">
                            <div>
                                <p class="text-sm text-gray-500">Mentor</p>
                                <p class="text-xl font-bold text-gray-900">{{ $room->mentor->name }}</p>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-5">
                            {{ $room->mentor->mentorProfile->bio ?? 'Mentor ini belum menambahkan bio.' }}
                        </p>

                        @if($room->mentor->mentorProfile && $room->mentor->mentorProfile->skills->isNotEmpty())
                        <h4 class="font-semibold text-gray-700 mb-2 text-sm">Keahlian Utama:</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($room->mentor->mentorProfile->skills as $skill)
                                <span class_alias="badge-gray-small">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Room</h3>
                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between items-center">
                                <span class="font-medium text-gray-600">🗓️ Mulai</span>
                                <span class="text-gray-800 font-semibold">{{ $room->started_at->format('j M Y, H:i') }}</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="font-medium text-gray-600">🏁 Selesai</span>
                                <span class="text-gray-800 font-semibold">{{ $room->end_at->format('j M Y, H:i') }}</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="font-medium text-gray-600">👥 Peserta</span>
                                <span class="text-gray-800 font-semibold">{{ $room->members_count ?? '0' }} Peserta</span> 
                            </li>
                        </ul>
                    </div>
                </aside>

            </div>
        </div>
    </div>

    <style>
        .badge-gray-small {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            background-color: #F3F4F6; /* gray-100 */
            color: #1F2937; /* gray-800 */
        }
    </style>
</x-app-layout>