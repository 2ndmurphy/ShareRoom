<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="{{ csrf_token() }}" name="csrf-token">

  <title>{{ config('app.name', 'ShareRoom') }} - Mentor</title>

  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
  <div class="flex min-h-screen bg-gray-100" x-data="{ open: false }">
    {{-- MAIN AREA --}}
    <div class="flex flex-1 flex-col overflow-hidden">

      {{-- TOP BAR --}}
      <header class="flex h-20 items-center justify-between border-b border-gray-200 bg-white px-8 shadow-sm">

        {{-- LEFT: LOGO + TITLE --}}
        <div class="flex items-center gap-3">
          <img alt="shareroom-icon" class="h-12 w-12 object-contain"
            src="{{ asset('images/icons/shareroom-icon.webp') }}">

          <div>
            <p class="text-sm font-semibold leading-tight text-teal-500">ShareRoom</p>
            <p class="text-xl font-bold leading-tight text-slate-800">Explore Area</p>
          </div>
        </div>

        {{-- MIDDLE: SEARCH --}}
        <div class="max-w-xl flex-1 px-10">
          <div class="relative">
            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1.6" />
              </svg>
            </span>
            <input
              class="w-full rounded-full border border-gray-200 bg-gray-50 py-2.5 pl-11 pr-4 text-sm focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-400"
              placeholder="Search...." type="text">
          </div>
        </div>

        {{-- RIGHT: USER DROPDOWN --}}
        <div class="relative flex items-center space-x-4" x-data="{ open: false }">
            @auth
                <a href="" class="py-3 px-6 border-2 border-teal-500 rounded-xl text-md font-semibold text-gray-500">Dashboard</a>
            @endauth
          {{-- AVATAR BUTTON --}}
          <button @click="open = !open" class="flex items-center gap-3 rounded-full p-1 transition hover:bg-gray-100">

            <img alt="User Avatar" class="h-11 w-11 rounded-full object-cover shadow-sm"
              src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}">

            {{-- <span class="hidden text-sm font-semibold text-slate-700 md:block">
              {{ Auth::user()->name }}
            </span> --}}
          </button>

          {{-- DROPDOWN MENU --}}
          <div @click.outside="open = false"
            class="absolute right-0 z-50 mt-3 w-48 rounded-xl border border-gray-200 bg-white py-2 shadow-lg"
            x-show="open" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter="transition ease-out duration-200"
            x-transition:leave-end="opacity-0 translate-y-2" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150">

            {{-- Edit Profile --}}
            <a class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-gray-50"
              href="{{ route('profile.edit', auth()->user()) }}">
              <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2" />
              </svg>
              Edit Profile
            </a>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-gray-50"
                type="submit">

                <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>

                Logout
              </button>
            </form>
          </div>
        </div>

      </header>


      {{-- CONTENT --}}
      <main class="flex-1 overflow-y-auto overflow-x-hidden bg-teal-400">
        <div class="px- mx-auto max-w-6xl py-6">

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
