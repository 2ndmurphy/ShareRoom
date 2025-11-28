<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShareRoom') }} - Mentor</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ open: false }" class="min-h-screen flex bg-gray-100">

        {{-- SIDEBAR --}}
        @include('layouts.partials.mentor-sidebar')

        {{-- MAIN AREA --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- TOP BAR --}}
            <header class="h-20 flex items-center justify-between px-8 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex-1 max-w-xl">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                      d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                            </svg>
                        </span>
                        <input
                            type="text"
                            placeholder="Search...."
                            class="w-full rounded-full border border-gray-200 bg-gray-50 pl-11 pr-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent"
                        >
                    </div>
                </div>

                <a href="{{ route('mentor.rooms.create') }}"
                   class="ml-6 inline-flex items-center gap-2 rounded-full bg-teal-500 hover:bg-teal-600
                          text-white text-sm font-semibold px-5 py-2.5 shadow-sm">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/15">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M12 5v14m7-7H5" />
                        </svg>
                    </span>
                    <span>Create New Room</span>
                </a>
            </header>

            {{-- CONTENT --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-teal-400">
                <div class="px-8 py-8 max-w-6xl mx-auto">

                    @if (session('status'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Wrap khusus halaman dashboard dengan card hijau --}}
                    @if (request()->routeIs('mentor.dashboard.index'))
                            @yield('content')
                    @else
                        @yield('content')
                    @endif

                </div>
            </main>
        </div>
    </div>
</body>
</html>
