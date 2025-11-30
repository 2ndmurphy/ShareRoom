@extends('layouts.learner')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER ROOM --}}
            <div class="mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            @if($room->roomType)
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-3 py-1
                                           text-[11px] font-semibold uppercase tracking-wide text-indigo-600">
                                    {{ $room->roomType->name }}
                                </span>
                            @endif
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1
                                       text-[11px] font-medium text-slate-600 capitalize">
                                💻 {{ $room->mode }}
                            </span>
                        </div>

                        <h1 class="text-2xl md:text-3xl font-bold text-white">
                            {{ $room->title }}
                        </h1>
                        <p class="mt-1 text-sm md:text-base text-white">
                            Dibimbing oleh
                            <span class="font-semibold text-white">
                                {{ $room->mentor->name }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- CONTENT GRID --}}
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                {{-- MAIN --}}
                <main class="lg:col-span-2">
                    <div x-data="{ tab: 'materi' }"
                         class="bg-white/95 backdrop-blur-sm shadow-sm rounded-3xl border border-slate-100 overflow-hidden">

                        {{-- TABS --}}
                        <nav class="border-b border-slate-100 bg-slate-50/60">
                            <div class="px-4 md:px-6">
                                <ul class="flex items-center gap-4 md:gap-8 text-sm font-semibold">
                                    <li>
                                        <button
                                            @click="tab = 'materi'"
                                            :class="tab === 'materi'
                                                ? 'text-slate-900 border-b-2 border-indigo-500'
                                                : 'text-slate-400 border-b-2 border-transparent hover:text-slate-700'"
                                            class="py-4 inline-flex items-center gap-2 transition-colors">
                                            <span class="text-xs">📚</span>
                                            <span>Materi & Progres</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            @click="tab = 'diskusi'"
                                            :class="tab === 'diskusi'
                                                ? 'text-slate-900 border-b-2 border-indigo-500'
                                                : 'text-slate-400 border-b-2 border-transparent hover:text-slate-700'"
                                            class="py-4 inline-flex items-center gap-2 transition-colors">
                                            <span class="text-xs">💬</span>
                                            <span>Diskusi</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                        {{-- TAB CONTENT --}}
                        <div class="p-6 md:p-8 space-y-6">

                            {{-- TAB MATERI --}}
                            <section x-show="tab === 'materi'" x-cloak>
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-xl md:text-2xl font-semibold text-slate-900">
                                        Daftar Materi
                                    </h2>
                                    <p class="text-xs text-slate-400">
                                        @if($room->materials->count())
                                            {{ $room->materials->count() }} materi tersedia
                                        @else
                                            Belum ada materi
                                        @endif
                                    </p>
                                </div>

                                @if($room->materials->count())
                                    <ul class="space-y-4">
                                        @foreach ($room->materials as $material)
                                            <li
                                                class="flex flex-col md:flex-row md:items-center md:justify-between gap-3
                                                       p-4 md:p-5 rounded-2xl border border-slate-100 bg-slate-50/70
                                                       hover:bg-white hover:shadow-md transition-all duration-150">

                                                <div class="flex items-start gap-3 md:gap-4">
                                                    {{-- Checkbox / progress marking (nanti bisa dihubungkan ke DB) --}}
                                                    <input
                                                        type="checkbox"
                                                        class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">

                                                    {{-- Icon + text --}}
                                                    <div class="flex items-start gap-3">
                                                        <div
                                                            class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-2xl
                                                                   bg-indigo-50 text-xl">
                                                            @if($material->type == 'file')
                                                                📄
                                                            @elseif($material->type == 'link')
                                                                🔗
                                                            @else
                                                                📝
                                                            @endif
                                                        </div>

                                                        <div>
                                                            <h3 class="font-semibold text-slate-900 leading-snug">
                                                                {{ $material->title }}
                                                            </h3>
                                                            @if($material->description)
                                                                <p class="mt-1 text-sm text-slate-500 line-clamp-2">
                                                                    {{ $material->description }}
                                                                </p>
                                                            @endif
                                                            <p class="mt-1 text-[11px] uppercase tracking-wide text-slate-400">
                                                                @if($material->type == 'file')
                                                                    File Materi
                                                                @elseif($material->type == 'link')
                                                                    Link Eksternal
                                                                @else
                                                                    Konten Teks
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- CTA Lihat --}}
                                                <div class="flex md:flex-none">
                                                    <button
                                                        class="inline-flex items-center justify-center gap-2
                                                               rounded-full bg-indigo-100 px-4 py-1.5 text-xs
                                                               font-semibold text-indigo-700
                                                               hover:bg-indigo-200 transition">
                                                        Lihat
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div
                                        class="mt-4 rounded-2xl border border-dashed border-slate-200 bg-slate-50/70
                                               px-6 py-8 text-center">
                                        <p class="text-sm font-medium text-slate-700 mb-1">
                                            Belum ada materi yang dipublikasikan.
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            Tunggu mentor menambahkan materi untuk room ini.
                                        </p>
                                    </div>
                                @endif
                            </section>

                            {{-- TAB DISKUSI --}}
                            <section x-show="tab === 'diskusi'" x-cloak>
                                <h2 class="text-xl md:text-2xl font-semibold text-slate-900 mb-3">
                                    Diskusi Room
                                </h2>
                                <p class="text-sm text-slate-500 mb-5">
                                    Fitur diskusi akan segera hadir. Nantinya kamu dapat bertanya kepada mentor dan berdiskusi
                                    dengan peserta lain di room ini.
                                </p>

                                <div
                                    class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/80 px-6 py-7 text-center">
                                    <p class="text-sm font-medium text-slate-700 mb-1">
                                        Coming Soon
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        Fitur komentar, tanya jawab, dan pengumuman mentor akan tersedia di sini.
                                    </p>
                                </div>
                            </section>

                        </div>
                    </div>
                </main>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-1 space-y-6">

                    {{-- PROGRES SAYA --}}
                    <div class="bg-white/95 backdrop-blur-sm shadow-sm rounded-3xl border border-slate-100 p-6">
                        <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-xl bg-emerald-50 text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            Progres Saya
                        </h3>

                        {{-- progress bar dummy (0%) --}}
                        <div class="mt-2">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                                    Progress Belajar
                                </span>
                                <span class="text-xs font-semibold text-slate-700">
                                    0%
                                </span>
                            </div>
                            <div class="w-full h-2.5 rounded-full bg-slate-100 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-500"
                                     style="width: 0%"></div>
                            </div>
                            <p class="mt-2 text-xs text-slate-500">
                                Tandai materi yang sudah kamu pelajari untuk melihat progres di sini.
                            </p>
                        </div>
                    </div>

                    {{-- TENTANG ROOM --}}
                    <div class="bg-white/95 backdrop-blur-sm shadow-sm rounded-3xl border border-slate-100 p-6">
                        <h3 class="text-sm font-semibold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-xl bg-indigo-50 text-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            Tentang Room Ini
                        </h3>

                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500 flex items-center gap-2">
                                    <span>🗓️</span>
                                    <span class="font-medium">Mulai</span>
                                </span>
                                <span class="font-semibold text-slate-800">
                                    {{ $room->started_at->format('j M Y') }}
                                </span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500 flex items-center gap-2">
                                    <span>🏁</span>
                                    <span class="font-medium">Selesai</span>
                                </span>
                                <span class="font-semibold text-slate-800">
                                    {{ $room->end_at->format('j M Y') }}
                                </span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-slate-500 flex items-center gap-2">
                                    <span>💻</span>
                                    <span class="font-medium">Mode</span>
                                </span>
                                <span class="font-semibold text-slate-800 capitalize">
                                    {{ $room->mode }}
                                </span>
                            </li>
                        </ul>
                    </div>

                </aside>
            </div>
        </div>
    </div>
@endsection
