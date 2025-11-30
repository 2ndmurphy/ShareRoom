@extends('layouts.mentor')

@section('content')
    {{-- HEADER WELCOME --}}
    <div class="text-white">
        <p class="text-lg font-medium">Welcome aboard,</p>
        <h1 class="text-3xl md:text-4xl font-bold mt-1">
            {{ auth()->user()->name ?? 'Bagol' }}...
        </h1>
    </div>

    {{-- GRID ROOM --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($rooms as $room)
            @include('layouts.partials._room-card', ['room' => $room])
        @empty
            <div class="md:col-span-2 bg-white/95 p-8 rounded-3xl shadow-sm text-center text-gray-600">
                <p class="text-base font-semibold">Anda belum membuat room.</p>
                <p class="text-sm mt-2">
                    Klik tombol <span class="font-semibold">Create New Room</span> di kanan atas untuk memulai.
                </p>
            </div>
        @endforelse
    </div>
@endsection
