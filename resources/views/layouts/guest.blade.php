<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShareRoom') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex flex-col md:flex-row">
        <div
            class="hidden md:flex md:w-1/2 bg-teal-400 text-white relative overflow-hidden items-center justify-center px-8 lg:px-16">
            <div class="absolute -top-32 -left-32 w-72 h-72 bg-white rounded-full"></div>
            <div class="absolute -bottom-32 -right-40 w-96 h-96 bg-teal-500 rounded-full opacity-60"></div>

            <div class="relative z-10 max-w-xl">
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight">
                    Share Your Skills<br>
                    And Inspire<br>
                    Others.
                </h1>
            </div>
        </div>

        <div class="w-full md:w-1/2 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-10 py-10">
            {{-- Logo + nama app --}}
            <div class="mb-8 flex items-center gap-3">
                <img src="{{ asset('images/icons/shareroom-icon.webp') }}" alt="Shareroom" class="w-24 h-24">
                <span class="text-3xl font-semibold text-teal-500">
                    {{ config('app.name', 'ShareRoom') }}
                </span>
            </div>

            <div class="w-full max-w-md">
                <div class="bg-teal-400 rounded-3xl px-8 py-8 shadow-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
