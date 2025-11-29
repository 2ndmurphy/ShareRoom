<!-- INI HALAMAN MEMBUAT MATERI UNTUK ROOM (MENTOR)-->
@extends('layouts.mentor')

@section('content')
    <div class="w-full bg-teal-400/95 px-4 py-4 md:py-4">
        <div class="max-w-3xl mx-auto bg-white/90 rounded-[32px] shadow-lg px-6 md:px-10 py-8 md:py-10">

            {{-- Header kecil di dalam card --}}
            <h1 class="text-xl md:text-2xl font-semibold text-slate-900 mb-6">
                Tambah Materi Baru
                <span class="block md:inline text-sm md:text-base text-slate-500 font-normal">
                    di {{ $room->title }}
                </span>
            </h1>

            <form action="{{ route('mentor.rooms.materials.store', $room) }}" method="POST" enctype="multipart/form-data"
                x-data="{ type: '{{ old('type', 'file') }}' }" class="space-y-6">
                @csrf

                @include('partials._form-errors')

                {{-- Judul Materi --}}
                <div class="space-y-2">
                    <label for="title" class="block text-base font-semibold text-slate-800">
                        Judul Materi
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full rounded-full border-2 border-gray-300 px-5 py-2.5 text-sm text-slate-800
                                  focus:border-teal-400 focus:ring-4 focus:ring-teal-100 outline-none
                                  placeholder:text-gray-400 transition"
                        placeholder="contoh: Pengantar HTML & CSS">
                </div>

                {{-- Deskripsi Singkat --}}
                <div class="space-y-2">
                    <label for="description" class="block text-base font-semibold text-slate-800">
                        Deskripsi Singkat
                    </label>
                    <textarea id="description" name="description" rows="2"
                        class="w-full rounded-full border-2 border-gray-300 px-5 py-2.5 text-sm text-slate-800
                                     focus:border-teal-400 focus:ring-4 focus:ring-teal-100 outline-none
                                     placeholder:text-gray-400 transition resize-none"
                        placeholder="Apa yang akan dilakukan dalam room ini?">{{ old('description') }}</textarea>
                </div>

                {{-- Tipe Materi --}}
                <div class="space-y-2">
                    <label for="type" class="block text-base font-semibold text-slate-800">
                        Tipe Materi
                    </label>
                    <div class="relative">
                        <select name="type" id="type" x-model="type"
                            class="w-full appearance-none rounded-full border-2 border-gray-300 px-5 py-2.5
                                       text-sm text-slate-800 bg-white focus:border-teal-400 focus:ring-4
                                       focus:ring-teal-100 outline-none transition">
                            <option value="">-Pilih-</option>
                            <option value="file" @selected(old('type', 'file') === 'file')>File (PDF, Doc, dll)</option>
                            <option value="link" @selected(old('type') === 'link')>Link (URL)</option>
                            <option value="text" @selected(old('type') === 'text')>Teks (Artikel)</option>
                        </select>
                        {{-- icon panah --}}
                        <span class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-gray-500">
                            ▾
                        </span>
                    </div>
                </div>

                {{-- Upload File --}}
                <div x-show="type === 'file'" x-cloak class="space-y-2">
                    <label for="file_upload" class="block text-base font-semibold text-slate-800">
                        Upload File
                    </label>

                    <div class="rounded-[24px] border-2 border-gray-300 px-4 py-3 bg-white flex items-center">
                        <input type="file" id="file_upload" name="file_upload"
                            class="w-full text-sm text-gray-500
                                      file:mr-4 file:rounded-full file:border-0
                                      file:bg-teal-500 file:px-5 file:py-2
                                      file:text-white file:font-semibold
                                      hover:file:bg-teal-600 cursor-pointer bg-transparent">
                    </div>
                </div>

                {{-- Link URL --}}
                <div x-show="type === 'link'" x-cloak class="space-y-2">
                    <label for="link_url" class="block text-base font-semibold text-slate-800">
                        URL / Link
                    </label>
                    <input type="url" id="link_url" name="link_url" value="{{ old('link_url') }}"
                        class="w-full rounded-full border-2 border-gray-300 px-5 py-2.5 text-sm text-slate-800
                                  focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none
                                  placeholder:text-gray-400 transition"
                        placeholder="https://contoh.com/materi-anda">
                </div>

                {{-- Konten Teks --}}
                <div x-show="type === 'text'" x-cloak class="space-y-2">
                    <label for="content" class="block text-base font-semibold text-slate-800">
                        Konten Teks
                    </label>
                    <textarea id="content" name="content" rows="8"
                        class="w-full rounded-3xl border-2 border-gray-300 px-5 py-3 text-sm text-slate-800
                                     focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"
                        placeholder="Tulis materi dalam bentuk artikel di sini...">{{ old('content') }}</textarea>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('mentor.rooms.show', $room) }}"
                        class="px-6 py-2.5 rounded-full bg-gray-200 text-m font-medium text-gray-700
                              hover:bg-gray-300 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-full text-white font-bold bg-teal-500 shadow-md hover:bg-teal-600 transition duration-200 active:scale-[0.99] transition">
                        Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection