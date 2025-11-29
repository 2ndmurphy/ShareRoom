<!-- INI HALAMAN UNTUK MENGEDIT ROOM YANG SUDAH ADA (MENTOR) -->
@extends('layouts.mentor')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- HEADER PAGE --}}
        <div class="mb-6">
            <p class="text-xl font-semibold uppercase tracking-wide text-white mb-1">
                Mentor Room
            </p>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-4xl md:text-4xl font-bold text-white">
                        Edit Post Undangan
                    </h1>
                    <p class="mt-1.5 text-xl text-teal-50 max-w-4xl">
                        Post undangan untuk
                        <span class="font-semibold">{{ $room->title }}</span>.  
                        Sesuaikan judul dan isi undangan agar calon peserta paham manfaat bergabung
                        ke room ini.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <form action="{{ route('mentor.rooms.posts.update', [$room, $post]) }}" method="POST"
              class="bg-white/90 backdrop-blur-sm border border-gray-100 shadow-lg rounded-3xl p-6 md:p-8">
            @csrf
            @method('PUT')

            {{-- ERROR ALERT --}}
            @include('partials._form-errors')

            {{-- JUDUL POST --}}
            <div class="mb-5">
                <label for="title" class="flex items-center justify-between mb-1.5">
                    <span class="text-sm font-semibold text-gray-800">Judul Post</span>
                    <span class="text-[11px] text-gray-400">Tampilkan value utama room kamu</span>
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $post->title) }}"
                    class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-sm
                           focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent"
                    placeholder="Contoh: Pendaftaran Room Laravel Batch 5 Dibuka!">
            </div>

            {{-- ISI UNDANGAN --}}
            <div class="mb-6">
                <label for="content" class="flex items-center justify-between mb-1.5">
                    <span class="text-sm font-semibold text-gray-800">Isi Undangan</span>
                    <span class="text-[11px] text-gray-400">Jelaskan benefit, jadwal, dan cara daftar</span>
                </label>
                <textarea
                    id="content"
                    name="content"
                    rows="10"
                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 text-sm leading-relaxed
                           focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent resize-none"
                    placeholder="Tuliskan penjelasan singkat mengenai tujuan room, siapa yang cocok bergabung, jadwal, dan link pendaftaran.">{{ old('content', $post->content) }}</textarea>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('mentor.rooms.show', $room) }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-full border border-gray-200
                          text-sm font-medium text-gray-600 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 rounded-full text-sm font-semibold
                               bg-teal-500 text-white shadow-md hover:bg-teal-600 transition duration-200">
                    Publikasikan Post
                </button>
            </div>
        </form>
    </div>
@endsection
