{{-- resources/views/explore/rooms/show.blade.php --}}
@extends('layouts.learner')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- MAIN CONTENT --}}
        <main class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-3xl shadow-md border border-slate-100 overflow-hidden">
                {{-- BACK BUTTON --}}
                <a href="{{route('explore.index')}}"
                class="inline-flex items-center gap-2 text-sm font-medium text-teal-600
                        px-4 py-2 rounded-lg bg-white
                        hover:hover:text-teal-800 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>

                {{-- HEADER ROOM --}}
                <div class="px-6 md:px-10 pt-6 md:pt-8 pb-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-teal-50">
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-3 leading-tight">
                        {{ $room->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                            {{ $room->roomType->name }}
                        </span>

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700 capitalize">
                            💻 {{ $room->mode }}
                        </span>

                        @if($room->location)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                📍 {{ $room->location }}
                            </span>
                        @endif
                    </div>

                    <p class="text-xs text-slate-500">
                        Room dibuat oleh
                        <span class="font-semibold text-slate-700">{{ $room->mentor->name }}</span>
                    </p>
                </div>

                {{-- BODY --}}
                <div class="p-6 md:p-10 space-y-8">

                    {{-- CTA JOIN / LEAVE --}}
<div class="bg-white rounded-2xl border border-slate-200 p-5 md:p-6 shadow-sm">

    @auth
        @if ($isMember)

            {{-- Already Joined --}}
            <div class="space-y-4 text-center">

                <p class="text-sm font-semibold text-emerald-600 flex items-center justify-center gap-2">
                    <span class="text-lg">🟢</span> Anda sudah bergabung di room ini
                </p>

                <form action="{{ route('explore.room.leave', $room) }}" method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin keluar dari room ini?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2
                               px-5 py-2.5 rounded-lg text-sm font-semibold text-white
                               bg-red-500 hover:bg-red-600 active:bg-red-700
                               transition-all shadow-sm hover:shadow-md
                               focus:outline-none focus:ring-2 focus:ring-red-400/50">
                        Keluar dari Room
                    </button>
                </form>

            </div>

        @else

            {{-- Not Joined Yet --}}
            <form action="{{ route('explore.room.join', $room) }}" method="POST" class="space-y-4">
                @csrf

                <p class="text-sm text-slate-600 leading-relaxed">
                    Tertarik dengan room ini? Klik tombol di bawah untuk bergabung dan mulai belajar bersama mentor.
                </p>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg text-sm font-semibold text-white
                           bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800
                           transition-all shadow-sm hover:shadow-md
                           focus:outline-none focus:ring-2 focus:ring-indigo-400/50">
                    Gabung Room Ini
                </button>
            </form>

        @endif

    @else

        {{-- Guest User --}}
        <div class="space-y-4 text-center md:text-left">
            <p class="text-sm text-slate-600">
                Login terlebih dahulu untuk dapat bergabung ke room ini.
            </p>

            <a href="{{ route('login') }}"
                class="inline-flex justify-center items-center gap-2 w-full
                       px-5 py-2.5 rounded-lg text-sm font-semibold text-white
                       bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800
                       transition-all shadow-sm hover:shadow-md
                       focus:outline-none focus:ring-2 focus:ring-indigo-400/50">
                Login untuk Bergabung
            </a>
        </div>

    @endauth

</div>


                    {{-- DESKRIPSI & MATERI --}}
                    <section class="space-y-6">
                        {{-- Deskripsi --}}
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900 mb-2">
                                Deskripsi Room
                            </h2>
                            <p class="text-sm md:text-base text-slate-700 leading-relaxed">
                                {{ $room->description ?: 'Belum ada deskripsi yang ditambahkan untuk room ini.' }}
                            </p>
                        </div>

                        {{-- Persyaratan --}}
                        @if($room->requirements)
                            <div>
                                <h2 class="text-lg font-semibold text-slate-900 mb-2">
                                    Persyaratan
                                </h2>
                                <p class="text-sm md:text-base text-slate-700 leading-relaxed">
                                    {{ $room->requirements }}
                                </p>
                            </div>
                        @endif

                        {{-- Materi --}}
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900 mb-2">
                                Apa yang akan Anda Pelajari
                            </h2>
                            <p class="text-sm text-slate-600 mb-3">
                                Berikut daftar materi yang akan dibahas di dalam room:
                            </p>

                            @if($room->materials->isNotEmpty())
                                <ol class="list-decimal list-inside space-y-3 text-sm md:text-base">
                                    @foreach ($room->materials as $material)
                                        <li class="font-medium text-slate-800 flex items-start gap-2">
                                            <span>{{ $material->title }}</span>
                                            @if($material->type == 'file')
                                                <span class="text-slate-500" title="File">📄</span>
                                            @elseif($material->type == 'link')
                                                <span class="text-slate-500" title="Link Eksternal">🔗</span>
                                            @else
                                                <span class="text-slate-500" title="Teks/Artikel">📝</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            @else
                                <p class="text-sm text-slate-500 italic">
                                    Mentor belum mempublikasikan materi untuk room ini.
                                </p>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </main>

        {{-- SIDEBAR --}}
        <aside class="lg:col-span-1">
            <div class="space-y-6 lg:sticky lg:top-24">

                {{-- CARD MENTOR --}}
                <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-14 w-14 rounded-full object-cover mr-4 shadow-sm"
                             src="https://ui-avatars.com/api/?name={{ urlencode($room->mentor->name) }}&background=random&color=fff"
                             alt="{{ $room->mentor->name }}'s avatar">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-slate-400">Mentor</p>
                            <p class="text-lg font-bold text-slate-900 leading-tight">
                                {{ $room->mentor->name }}
                            </p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                        {{ $room->mentor->mentorProfile->bio ?? 'Mentor ini belum menambahkan bio.' }}
                    </p>

                    @if($room->mentor->mentorProfile && $room->mentor->mentorProfile->skills->isNotEmpty())
                        <h4 class="font-semibold text-slate-800 mb-2 text-sm">
                            Keahlian Utama
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($room->mentor->mentorProfile->skills as $skill)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- CARD DETAIL ROOM --}}
                <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6">
                    <h3 class="text-sm font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3M5 11h14M5 20h14a2 2 0 002-2v-7H3v7a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        Detail Room
                    </h3>

                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between items-center">
                            <span class="font-medium text-slate-600 flex items-center gap-1">
                                🗓️ Mulai
                            </span>
                            <span class="text-slate-900 font-semibold">
                                {{ $room->started_at->format('j M Y, H:i') }}
                            </span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="font-medium text-slate-600 flex items-center gap-1">
                                🏁 Selesai
                            </span>
                            <span class="text-slate-900 font-semibold">
                                {{ $room->end_at->format('j M Y, H:i') }}
                            </span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="font-medium text-slate-600 flex items-center gap-1">
                                👥 Peserta
                            </span>
                            <span class="text-slate-900 font-semibold">
                                {{ $room->members_count ?? '0' }} Peserta
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
        </aside>

    </div>
@endsection
