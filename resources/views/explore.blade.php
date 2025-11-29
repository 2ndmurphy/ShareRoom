@extends('layouts.learner')

@section('content')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- MAIN FEED --}}
                <div class="md:col-span-2 space-y-6">

                    {{-- Header + Tabs --}}
                    <div class="bg-white rounded-3xl border border-slate-200 px-5 py-4 flex flex-col gap-3 shadow-sm">
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-slate-900">
                                Undangan Room
                            </h1>
                            <p class="text-sm text-slate-500 mt-1">
                                Jelajahi undangan kelas dari berbagai mentor. Pilih room yang paling cocok buat kamu.
                            </p>
                        </div>

                        <div class="flex items-center gap-6 text-sm font-semibold text-slate-600 border-t border-slate-100 pt-2">
                            <button class="pb-2 border-b-2 border-slate-900 text-slate-900">
                                Relevant
                            </button>
                            <button class="pb-2 hover:text-slate-900">
                                Latest
                            </button>
                            <button class="pb-2 hover:text-slate-900">
                                Top
                            </button>
                        </div>
                    </div>

                    {{-- Daftar Post --}}
                    <div class="space-y-5">
                        @forelse ($posts as $post)
                            @include('partials._post-card', ['post' => $post])
                        @empty
                            <div class="bg-white rounded-3xl border border-dashed border-slate-200 shadow-sm">
                                <div class="p-8 text-center">
                                    <h3 class="text-lg font-semibold text-slate-800">
                                        Belum Ada Undangan
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">
                                        Saat ini belum ada mentor yang mempublikasikan undangan room baru.
                                        Coba cek lagi nanti, ya. 🙂
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if ($posts->hasPages())
                        <div class="pt-4 flex justify-center">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <aside class="md:col-span-1 space-y-6">

                    {{-- Tipe Room --}}
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                        <h3 class="text-sm font-semibold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h10M4 18h6"/>
                                </svg>
                            </span>
                            Tipe Room
                        </h3>

                        <ul class="space-y-2 text-sm">
                            @isset($roomTypes)
                                @foreach($roomTypes as $type)
                                    <li>
                                        <a href="#"
                                           class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-50 text-slate-700 group">
                                            <div class="flex items-center">
                                                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-3 group-hover:scale-110 transition-transform"></span>
                                                <span class="group-hover:text-slate-900 group-hover:font-semibold">
                                                    {{ $type->name }}
                                                </span>
                                            </div>
                                            <span class="text-[11px] text-slate-400 italic">
                                                Room
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-xs text-slate-400">
                                    Tipe room belum tersedia.
                                </li>
                            @endisset
                        </ul>
                    </div>

                    {{-- Mentor Populer --}}
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                        <h3 class="text-sm font-semibold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-50 text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.5 21a8.38 8.38 0 0113 0M12 11a4 4 0 100-8 4 4 0 000 8z"/>
                                </svg>
                            </span>
                            Mentor Populer
                        </h3>

                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="h-9 w-9 rounded-full object-cover mr-3"
                                         src="https://placehold.co/80x80" alt="Avatar">
                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            Mentor A
                                        </p>
                                        <p class="text-[11px] text-slate-400">
                                            Frontend & UI Design
                                        </p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-[11px] text-emerald-600 font-medium">
                                    Online
                                </span>
                            </li>

                            <li class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="h-9 w-9 rounded-full object-cover mr-3"
                                         src="https://placehold.co/80x80" alt="Avatar">
                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            Mentor B
                                        </p>
                                        <p class="text-[11px] text-slate-400">
                                            Backend & Database
                                        </p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-100 text-[11px] text-slate-600 font-medium">
                                    Busy
                                </span>
                            </li>
                        </ul>
                    </div>

                </aside>

            </div>



@endsection
