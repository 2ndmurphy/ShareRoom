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
        

        {{-- MAIN AREA --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- TOP BAR --}}
            {{-- TOP BAR --}}
<header class="h-20 flex items-center justify-between px-8 bg-white border-b border-gray-200 shadow-sm">

    {{-- LEFT: LOGO + TITLE --}}
    <div class="flex items-center gap-3">
        <img src="{{ asset('images/icons/shareroom-icon.webp') }}" 
             alt="shareroom-icon" 
             class="w-12 h-12 object-contain">

        <div>
            <p class="text-sm font-semibold text-teal-500 leading-tight">ShareRoom</p>
            <p class="text-xl font-bold text-slate-800 leading-tight">Explore Area</p>
        </div>
    </div>

    {{-- MIDDLE: SEARCH --}}
    <div class="flex-1 max-w-xl px-10">
        <div class="relative">
            <span class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                        d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                </svg>
            </span>
            <input type="text" placeholder="Search...."
                class="w-full rounded-full border border-gray-200 bg-gray-50 pl-11 pr-4 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
        </div>
    </div>

    {{-- RIGHT: USER DROPDOWN --}}
    <div x-data="{ open: false }" class="relative">

        {{-- AVATAR BUTTON --}}
        <button @click="open = !open"
            class="flex items-center gap-3 p-1 rounded-full hover:bg-gray-100 transition">

            <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                class="h-11 w-11 rounded-full object-cover shadow-sm" alt="User Avatar">

            <span class="hidden md:block font-semibold text-slate-700 text-sm">
                {{ Auth::user()->name }}
            </span>
        </button>

        {{-- DROPDOWN MENU --}}
        <div x-show="open"
             @click.outside="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">

            {{-- Edit Profile --}}
            <a href="{{ route('profile.edit', auth()->user()) }}"
               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-gray-50">
                <svg class="h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Edit Profile
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-gray-50">
                    
                    <svg class="h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>

                    Logout
                </button>
            </form>
        </div>
    </div>

</header>


            {{-- CONTENT --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-teal-400">
                <div class="px- py-6 max-w-6xl mx-auto">

                    @include('partials._toast-status')

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
