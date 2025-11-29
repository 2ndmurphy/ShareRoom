@extends('layouts.learner')

@section('content')

  <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

    {{-- MAIN FEED --}}
    <div class="space-y-6 md:col-span-2">

      {{-- Header + Tabs --}}
      <div class="flex flex-col gap-3 rounded-3xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
        <div>
          <h1 class="text-xl font-bold text-slate-900 md:text-2xl">
            Undangan Room
          </h1>
          <p class="mt-1 text-sm text-slate-500">
            Jelajahi undangan kelas dari berbagai mentor. Pilih room yang paling cocok buat kamu.
          </p>
        </div>

        <div class="flex items-center gap-6 border-t border-slate-100 pt-2 text-sm font-semibold text-slate-600">
          <button class="border-b-2 border-slate-900 pb-2 text-slate-900">
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
          <div class="rounded-3xl border border-dashed border-slate-200 bg-white shadow-sm">
            <div class="p-8 text-center">
              <h3 class="text-lg font-semibold text-slate-800">
                Belum Ada Undangan
              </h3>
              <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                Saat ini belum ada mentor yang mempublikasikan undangan room baru.
                Coba cek lagi nanti, ya. 🙂
              </p>
            </div>
          </div>
        @endforelse
      </div>

      {{-- Pagination --}}
      @if ($posts->hasPages())
        <div class="flex justify-center pt-4">
          {{ $posts->links() }}
        </div>
      @endif
    </div>

    {{-- SIDEBAR --}}
    <aside class="space-y-6 md:col-span-1">

      {{-- Tipe Room --}}
      <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-900">
          <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-500">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M4 6h16M4 12h10M4 18h6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
          </span>
          Tipe Room
        </h3>

        <ul class="space-y-2 text-sm">
          @isset($roomTypes)
            @foreach ($roomTypes as $type)
              <li>
                <a class="group flex items-center justify-between rounded-xl px-3 py-2 text-slate-700 hover:bg-slate-50"
                  href="#">
                  <div class="flex items-center">
                    <span class="mr-3 h-2 w-2 rounded-full bg-indigo-500 transition-transform group-hover:scale-110"></span>
                    <span class="group-hover:font-semibold group-hover:text-slate-900">
                      {{ $type->name }}
                    </span>
                  </div>
                  <span class="text-[11px] italic text-slate-400">
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
      <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-900">
          <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-50 text-emerald-500">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M5.5 21a8.38 8.38 0 0113 0M12 11a4 4 0 100-8 4 4 0 000 8z" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2" />
            </svg>
          </span>
          Mentor Populer
        </h3>

        <ul class="space-y-3 text-sm">
          <li class="flex items-center justify-between">
            <div class="flex items-center">
              <img alt="Avatar" class="mr-3 h-9 w-9 rounded-full object-cover" src="https://placehold.co/80x80">
              <div>
                <p class="font-semibold text-slate-800">
                  Mentor A
                </p>
                <p class="text-[11px] text-slate-400">
                  Frontend & UI Design
                </p>
              </div>
            </div>
            <span
              class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] font-medium text-emerald-600">
              Online
            </span>
          </li>

          <li class="flex items-center justify-between">
            <div class="flex items-center">
              <img alt="Avatar" class="mr-3 h-9 w-9 rounded-full object-cover" src="https://placehold.co/80x80">
              <div>
                <p class="font-semibold text-slate-800">
                  Mentor B
                </p>
                <p class="text-[11px] text-slate-400">
                  Backend & Database
                </p>
              </div>
            </div>
            <span
              class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-600">
              Busy
            </span>
          </li>
        </ul>
      </div>

    </aside>

  </div>



@endsection
