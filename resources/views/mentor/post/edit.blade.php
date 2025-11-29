<!-- INI HALAMAN UNTUK MENGEDIT ROOM YANG SUDAH ADA (MENTOR) -->
@extends('layouts.mentor')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Edit Post Undangan <span class="text-xl text-gray-500 font-normal">untuk {{ $room->title }}</span>
    </h1>

    <form action="{{ route('mentor.rooms.posts.update', [$room, $post]) }}" method="POST"
        class="bg-white p-6 md:p-8 rounded-lg shadow-md max-w-2xl">
        @csrf
        @method('PUT')

        @include('partials._form-errors')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Post</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Contoh: Pendaftaran Room Laravel Batch 5 Dibuka!">
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Isi Undangan</label>
            <textarea id="content" name="content" rows="10"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Jelaskan apa yang akan dipelajari di room ini...">{{ $post->content }}</textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('mentor.rooms.show', $room) }}"
                class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Batal
            </a>
            <button type="submit"
                class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                Publikasikan Post
            </button>
        </div>
    </form>
@endsection