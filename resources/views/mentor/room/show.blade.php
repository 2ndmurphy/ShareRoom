<!-- INI HALAMAN UNTUK MELIHAT DETAIL ROOM (MENTOR) -->
@extends('layouts.mentor')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8">

        {{-- Header Room --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl font-semibold text-white tracking-tight">
                    {{ $room->title }}
                </h1>
                <p class="text-xl md:text-xl text-white">
                    Kelola materi dan post undangan untuk room ini dari satu tempat.
                </p>
            </div>

            <div class="flex justify-start md:justify-end">
                <a href="{{ route('mentor.rooms.edit', $room) }}"
                   class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white/90 px-4 py-2.5
                          text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 hover:border-slate-400
                          transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-8.5 8.5A2 2 0 016.293 16H4a1 1 0 01-1-1v-2.293a2 2 0 01.586-1.414l8.5-8.5z" />
                    </svg>
                    <span>Edit Detail Room</span>
                </a>
            </div>
        </div>

        {{-- Grid Manajemen --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Manajemen Materi --}}
            <section class="bg-white/90 border border-slate-100 rounded-2xl shadow-sm p-5 md:p-6 flex flex-col">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Manajemen Materi</h2>
                        <p class="text-xs text-slate-500 mt-1">
                            Atur bahan belajar yang akan diakses oleh mentee.
                        </p>
                    </div>
                    <a href="{{ route('mentor.rooms.materials.create', $room) }}"
                       class="inline-flex items-center gap-1.5 rounded-full bg-teal-500 px-3 py-1.5 text-xs font-medium
                              text-white shadow-sm hover:bg-teal-600 transition">
                        <span class="text-sm">＋</span>
                        <span>Tambah Materi</span>
                    </a>
                </div>

                @if($room->materials->count())
                    <ul class="space-y-2">
                        @foreach ($room->materials->sortBy('created_at') as $material)
                            <li
                                class="flex items-center justify-between gap-3 rounded-xl border border-slate-200/80
                                       px-3 py-2.5 bg-gray-50 hover:bg-slate-100 transition">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-lg">
                                        @if($material->type == 'file') 📄
                                        @elseif($material->type == 'link') 🔗
                                        @else 📝
                                        @endif
                                    </span>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-slate-900 line-clamp-1">
                                            {{ $material->title }}
                                        </span>
                                        <span class="text-[11px] text-slate-400">
                                            {{ ucfirst($material->type) }} •
                                            Ditambahkan {{ $material->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 text-[11px]">
                                    <a href="{{ route('mentor.rooms.materials.edit', [$room, $material]) }}"
                                       class="rounded-full bg-slate-100 px-3 py-1 text-slate-700 hover:bg-slate-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('mentor.rooms.materials.destroy', [$room, $material]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus materi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-full bg-rose-50 px-3 py-1 text-rose-600 hover:bg-rose-100">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center text-center py-10">
                        <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-2xl">
                            📁
                        </div>
                        <p class="text-sm font-medium text-slate-700">Belum ada materi</p>
                        <p class="mt-1 text-xs text-slate-400 max-w-xs">
                            Tambahkan materi pertama agar mentee punya panduan belajar yang jelas.
                        </p>
                        <a href="{{ route('mentor.rooms.materials.create', $room) }}"
                           class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-sky-500 px-4 py-2 text-xs font-medium
                                  text-white shadow-sm hover:bg-sky-600 transition">
                            + Tambah Materi
                        </a>
                    </div>
                @endif
            </section>

            {{-- Manajemen Post --}}
            <section class="bg-white/90 border border-slate-100 rounded-2xl shadow-sm p-5 md:p-6 flex flex-col">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Manajemen Post Undangan</h2>
                        <p class="text-xs text-slate-500 mt-1">
                            Post yang akan tampil di halaman publik untuk menarik mentee.
                        </p>
                    </div>
                    <a href="{{ route('mentor.rooms.posts.create', $room) }}"
                       class="inline-flex items-center gap-1.5 rounded-full bg-teal-500 px-3 py-1.5 text-xs font-medium
                              text-white shadow-sm hover:bg-teal-600 transition">
                        <span class="text-sm">＋</span>
                        <span>Tulis Post</span>
                    </a>
                </div>

                @if($room->posts->count())
                    <ul class="space-y-2">
                        @foreach ($room->posts->sortByDesc('created_at') as $post)
                            <li
                                class="flex items-center justify-between gap-3 rounded-xl border border-slate-200/80
                                       px-3 py-2.5 bg-slate-50 hover:bg-slate-100 transition">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-slate-900 line-clamp-1">
                                        {{ $post->title }}
                                    </span>
                                    <span class="text-[11px] text-slate-400">
                                        Dipublikasikan {{ $post->created_at->format('d M Y') }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 text-[11px]">
                                    <a href="{{ route('mentor.rooms.posts.edit', [$room, $post]) }}"
                                       class="rounded-full bg-slate-100 px-3 py-1 text-slate-700 hover:bg-slate-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('mentor.rooms.posts.destroy', [$room, $post]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus post ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-full bg-rose-50 px-3 py-1 text-rose-600 hover:bg-rose-100">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center text-center py-10">
                        <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-2xl">
                            📨
                        </div>
                        <p class="text-sm font-medium text-slate-700">Belum ada post undangan</p>
                        <p class="mt-1 text-xs text-slate-400 max-w-xs">
                            Buat post undangan agar calon mentee tahu info dan link pendaftaran room ini.
                        </p>
                        <a href="{{ route('mentor.rooms.posts.create', $room) }}"
                           class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-emerald-500 px-4 py-2 text-xs font-medium
                                  text-white shadow-sm hover:bg-emerald-600 transition">
                            + Tulis Post
                        </a>
                    </div>
                @endif
            </section>

        </div>
    </div>
@endsection