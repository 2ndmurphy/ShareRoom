<!-- INI HALAMAN UNTUK MEMBUAT ROOM (MENTOR) -->
@extends('layouts.mentor')

@section('content')
    <div class="w-full px-2 md:px-0">
        <div class="max-w-3xl mx-auto">

            {{-- Card --}}
            <form action="{{ route('mentor.rooms.posts.store', $room) }}" method="POST"
                class="bg-white/90 border border-slate-100 rounded-[32px] shadow-lg p-8 md:p-12 space-y-10">

                {{-- Header --}}
                <header class="mb-6 md:mb-8">
                    <h1 class="text-xl md:text-4xl font-semibold text-slate-900 tracking-tight leading-snug">
                        Tulis Post Undangan Baru
                        <span class="block md:inline text-2xl md:text-3xl text-slate-500 font-normal">
                            untuk {{ $room->title }}
                        </span>
                    </h1>
                </header>

                @csrf
                @include('partials._form-errors')

                {{-- Judul --}}
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label for="title" class="text-base font-semibold text-slate-800">
                            Judul Post
                        </label>
                        <span class="text-[13px] text-slate-400">
                            Maksimal 100 karakter
                        </span>
                    </div>

                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full rounded-full border border-slate-300 bg-slate-50/70 px-6 py-3
                               text-base text-slate-900 shadow-inner
                               focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100
                               outline-none placeholder:text-slate-400 transition"
                        placeholder="Contoh: Pendaftaran Room Laravel Batch 5 Dibuka!">
                </div>

                {{-- Isi Undangan --}}
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label for="content" class="text-base font-semibold text-slate-800">
                            Isi Undangan
                        </label>
                    </div>

                    <textarea id="content" name="content" rows="5"
                        class="w-full rounded-3xl border border-slate-300 bg-slate-50/70 px-6 py-4
                               text-base text-slate-900 leading-relaxed
                               focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100
                               outline-none transition placeholder:text-slate-400 resize-y min-h-[220px]"
                        placeholder="Contoh:
• Apa yang akan dipelajari
• Durasi dan jadwal pertemuan
• Siapa yang cocok ikut
• Cara mendaftar atau join room">{{ old('content') }}</textarea>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-4 pt-6 border-t border-slate-200">
                    <a href="{{ route('mentor.rooms.show', $room) }}"
                        class="px-7 py-3 rounded-full bg-slate-200 text-base font-medium text-slate-700
                              hover:bg-slate-300 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-7 py-3 rounded-full bg-teal-500 text-base font-semibold text-white shadow-md
                               hover:bg-teal-600 active:scale-[0.98] transition">
                        Publikasikan Post
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection