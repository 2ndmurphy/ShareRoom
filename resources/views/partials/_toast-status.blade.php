@if (session('status'))
<div
    x-data="{ show: false }"
    x-cloak

    x-init="
        setTimeout(() => show = true, 10);
        setTimeout(() => show = false, 3800);
    "

    x-show="show"

    {{-- SLIDE IN FROM RIGHT --}}
    x-transition:enter="transition transform ease-out duration-400"
    x-transition:enter-start="opacity-0 translate-x-10"
    x-transition:enter-end="opacity-100 translate-x-0"

    {{-- SLIDE OUT TO RIGHT --}}
    x-transition:leave="transition transform ease-in duration-400"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-10"

    class="fixed top-6 right-6 z-[999] w-full max-w-sm"
>
    <div class="relative p-4 rounded-2xl
                backdrop-blur-lg bg-white/70 border border-white/40
                shadow-xl shadow-teal-200/40 flex items-start gap-4">

        {{-- ICON --}}
        <div class="flex h-10 w-10 items-center justify-center rounded-xl
                    bg-gradient-to-br from-teal-500 to-emerald-500 shadow-md shadow-teal-300/60">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
            </svg>
        </div>

        {{-- TEXT --}}
        <div class="flex-1 pr-6">
            <p class="text-xs font-semibold text-gray-700 uppercase">
                Berhasil
            </p>
            <p class="text-sm font-medium text-gray-800 mt-0.5 leading-relaxed">
                {{ session('status') }}
            </p>
        </div>

        {{-- CLOSE --}}
        <button @click="show = false"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

    </div>
</div>
@endif
