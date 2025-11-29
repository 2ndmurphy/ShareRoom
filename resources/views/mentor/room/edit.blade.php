@extends('layouts.mentor')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- HEADER PAGE --}}
        <div class="mb-6">
            <p class="text-lg font-semibold uppercase tracking-wide text-white mb-1">
                Mentor Room
            </p>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-4xl md:text-4xl font-bold text-white">
                        Edit Room
                    </h1>
                    <p class="mt-2 text-lg text-white max-w-xl">
                        Perbarui detail kelas yang ingin kamu buka, mulai dari tipe room, mode belajar,
                        jadwal, hingga persyaratan untuk peserta.
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM CARD --}}
        <form action="{{ route('mentor.rooms.update', $room) }}" method="POST"
              x-data="{ mode: '{{ old('mode', $room->mode) }}' }"
              class="bg-white/90 backdrop-blur-sm border border-gray-100 shadow-lg rounded-3xl p-6 md:p-8">
            @csrf
            @method('PUT')

            {{-- ERROR ALERT --}}
            @include('partials._form-errors')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- JUDUL ROOM --}}
                <div class="md:col-span-2">
                    <label for="title" class="flex items-center justify-between mb-1.5">
                        <span class="text-base font-semibold text-gray-800">Judul Room</span>
                        <span class="text-xs text-red-500">Wajib diisi</span>
                    </label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title', $room->title) }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                  focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent"
                           placeholder="Contoh: Belajar Laravel 11 dari Nol">
                </div>

                {{-- TIPE ROOM --}}
                <div>
                    <label for="type_id" class="block text-base font-semibold text-gray-800 mb-1.5">
                        Tipe Room
                    </label>
                    <select name="type_id" id="type_id"
                            class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                   focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        <option value="">-- Pilih Tipe Room --</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->id }}" {{ old('type_id', $room->type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- MODE ROOM --}}
                <div>
                    <label for="mode" class="block text-base font-semibold text-gray-800 mb-1.5">
                        Mode Room
                    </label>
                    <select name="mode" id="mode" x-model="mode"
                            class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                   focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        <option value="online" {{ old('mode', $room->mode) == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="offline" {{ old('mode', $room->mode) == 'offline' ? 'selected' : '' }}>Offline</option>
                        <option value="hybrid" {{ old('mode', $room->mode) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                    <p class="mt-1 text-[11px] text-gray-400">
                        Pilih <span class="font-medium text-gray-500">Offline</span> atau
                        <span class="font-medium text-gray-500">Hybrid</span> jika ada pertemuan tatap muka.
                    </p>
                </div>

                {{-- LOKASI (KONDISIONAL) --}}
                <div class="md:col-span-2"
                     x-show="mode === 'offline' || mode === 'hybrid'"
                     x-transition.opacity>
                    <label for="location" class="block text-base font-semibold text-gray-800 mb-1.5">
                        Lokasi <span class="text-red-500 text-xs font-normal">(Wajib jika Offline/Hybrid)</span>
                    </label>
                    <input type="text" id="location" name="location"
                           value="{{ old('location', $room->location) }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                  focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent"
                           placeholder="Contoh: Gedung A, Ruang 101">
                </div>

                {{-- WAKTU MULAI --}}
                <div>
                    <label for="started_at" class="block text-base font-semibold text-gray-800 mb-1.5">
                        Waktu Mulai
                    </label>
                    <input type="datetime-local" id="started_at" name="started_at"
                           value="{{ old('started_at', $room->started_at ? $room->started_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                  focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                </div>

                {{-- WAKTU SELESAI --}}
                <div>
                    <label for="end_at" class="block text-base font-semibold text-gray-800 mb-1.5">
                        Waktu Selesai
                    </label>
                    <input type="datetime-local" id="end_at" name="end_at"
                           value="{{ old('end_at', $room->end_at ? $room->end_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                  focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                </div>

                {{-- DESKRIPSI --}}
                <div class="md:col-span-2">
                    <label for="description" class="flex items-center justify-between mb-1.5">
                        <span class="text-base font-semibold text-gray-800">Deskripsi Singkat</span>
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                     focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent resize-none"
                              placeholder="Apa yang akan dipelajari di room ini?">{{ old('description', $room->description) }}</textarea>
                </div>

                {{-- PERSYARATAN --}}
                <div class="md:col-span-2">
                    <label for="requirements" class="block text-base font-semibold text-gray-800 mb-1.5">
                        Persyaratan
                    </label>
                    <textarea id="requirements" name="requirements" rows="3"
                              class="w-full px-4 py-2.5 rounded-2xl border border-gray-200 bg-gray-50 text-base
                                     focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent resize-none"
                              placeholder="Contoh: Wajib install PHP, Composer, dan VS Code.">{{ old('requirements', $room->requirements) }}</textarea>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('mentor.rooms.show', $room) }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-full border border-gray-200
                          text-base font-medium text-gray-600 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 rounded-full text-base font-semibold
                               bg-teal-500 text-white shadow-md hover:bg-teal-600 transition duration-200">
                    Update Room
                </button>
            </div>
        </form>
    </div>
@endsection