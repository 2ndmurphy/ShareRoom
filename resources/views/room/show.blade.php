{{-- resources/views/explore/rooms/show.blade.php --}}
@extends('layouts.learner')

@section('content')
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

    {{-- MAIN CONTENT --}}
    <main class="space-y-4 lg:col-span-2">
      <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-md">

        {{-- HEADER ROOM --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-teal-50 px-6 pb-4 pt-6 md:px-10 md:pt-8">
          <h1 class="mb-3 text-2xl font-bold leading-tight text-slate-900 md:text-3xl">
            {{ $room->title }}
          </h1>

          <div class="mb-2 flex flex-wrap items-center gap-2 md:gap-3">
            <span
              class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
              {{ $room->roomType->name }}
            </span>

            <span
              class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium capitalize text-slate-700">
              💻 {{ $room->mode }}
            </span>

            @if ($room->location)
              <span
                class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                📍 {{ $room->location }}
              </span>
            @endif
          </div>

          <p class="text-xs text-slate-500">
            Room dibuat oleh
            <span class="font-semibold text-slate-700">{{ $room->mentor->name }}</span>
          </p>
        </div>

        {{-- BODY --}}
        <div class="space-y-8 p-6 md:p-10">

          {{-- CTA JOIN / LEAVE --}}
          <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm md:p-6">

            @auth
              @if ($isMember)
                {{-- Already Joined --}}
                <div class="space-y-4 text-center">

                  <p class="flex items-center justify-center gap-2 text-sm font-semibold text-emerald-600">
                    <span class="text-lg">🟢</span> Anda sudah bergabung di room ini
                  </p>

                  <form action="{{ route('explore.room.leave', $room) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin keluar dari room ini?');">
                    @csrf
                    @method('DELETE')

                    <button
                      class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-red-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-red-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-red-400/50 active:bg-red-700"
                      type="submit">
                      Keluar dari Room
                    </button>
                  </form>

                </div>
              @else
                {{-- Not Joined Yet --}}
                <form action="{{ route('explore.room.join', $room) }}" class="space-y-4" method="POST">
                  @csrf

                  <p class="text-sm leading-relaxed text-slate-600">
                    Tertarik dengan room ini? Klik tombol di bawah untuk bergabung dan mulai belajar bersama mentor.
                  </p>

                  <button
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-teal-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-teal-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-400/50 active:bg-indigo-800"
                    type="submit">
                    Gabung Room
                  </button>
                </form>
              @endif
            @else
              {{-- Guest User --}}
              <div class="space-y-4 text-center md:text-left">
                <p class="text-sm text-slate-600">
                  Login terlebih dahulu untuk dapat bergabung ke room ini.
                </p>

                <a class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-400/50 active:bg-indigo-800"
                  href="{{ route('login') }}">
                  Login untuk Bergabung
                </a>
              </div>

            @endauth

          </div>


          {{-- DESKRIPSI & MATERI --}}
          <section class="space-y-6">
            {{-- Deskripsi --}}
            <div>
              <h2 class="mb-2 text-lg font-semibold text-slate-900">
                Deskripsi Room
              </h2>
              <p class="text-sm leading-relaxed text-slate-700 md:text-base">
                {{ $room->description ?: 'Belum ada deskripsi yang ditambahkan untuk room ini.' }}
              </p>
            </div>

            {{-- Persyaratan --}}
            @if ($room->requirements)
              <div>
                <h2 class="mb-2 text-lg font-semibold text-slate-900">
                  Persyaratan
                </h2>
                <p class="text-sm leading-relaxed text-slate-700 md:text-base">
                  {{ $room->requirements }}
                </p>
              </div>
            @endif

            {{-- Materi --}}
            <div>
              <h2 class="mb-2 text-lg font-semibold text-slate-900">
                Apa yang akan Anda Pelajari
              </h2>
              <p class="mb-3 text-sm text-slate-600">
                Berikut daftar materi yang akan dibahas di dalam room:
              </p>

              @if ($room->materials->isNotEmpty())
                <ol class="list-inside list-decimal space-y-3 text-sm md:text-base">
                  @foreach ($room->materials as $material)
                    <li class="flex items-start gap-2 font-medium text-slate-800">
                      <span>{{ $material->title }}</span>
                      @if ($material->type == 'file')
                        <span class="text-slate-500" title="File">📄</span>
                      @elseif($material->type == 'link')
                        <span class="text-slate-500" title="Link Eksternal">🔗</span>
                      @else
                        <span class="text-slate-500" title="Teks/Artikel">📝</span>
                      @endif
                    </li>
                  @endforeach
                </ol>
              @else
                <p class="text-sm italic text-slate-500">
                  Mentor belum mempublikasikan materi untuk room ini.
                </p>
              @endif
            </div>
          </section>
        </div>
      </div>
    </main>

    {{-- SIDEBAR --}}
    <aside class="lg:col-span-1">
      <div class="space-y-6 lg:sticky">

        {{-- CARD MENTOR --}}
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-md">
          <div class="mb-4 flex items-center">
            <img alt="{{ $room->mentor->name }}'s avatar" class="mr-4 h-14 w-14 rounded-full object-cover shadow-sm"
              src="https://ui-avatars.com/api/?name={{ urlencode($room->mentor->name) }}&background=random&color=fff">
            <div>
              <p class="text-xs uppercase tracking-wide text-slate-400">Mentor</p>
              <p class="text-lg font-bold leading-tight text-slate-900">
                {{ $room->mentor->name }}
              </p>
            </div>
          </div>

          <p class="mb-4 text-sm leading-relaxed text-slate-600">
            {{ $room->mentor->mentorProfile->bio ?? 'Mentor ini belum menambahkan bio.' }}
          </p>

          @if ($room->mentor->mentorProfile && $room->mentor->mentorProfile->skills->isNotEmpty())
            <h4 class="mb-2 text-sm font-semibold text-slate-800">
              Keahlian Utama
            </h4>
            <div class="flex flex-wrap gap-2">
              @foreach ($room->mentor->mentorProfile->skills as $skill)
                <span
                  class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-800">
                  {{ $skill->name }}
                </span>
              @endforeach
            </div>
          @endif
        </div>

        {{-- CARD DETAIL ROOM --}}
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-md">
          <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-900">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-500">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M8 7V3m8 4V3M5 11h14M5 20h14a2 2 0 002-2v-7H3v7a2 2 0 002 2z" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2" />
              </svg>
            </span>
            Detail Room
          </h3>

          <ul class="space-y-3 text-sm">
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-1 font-medium text-slate-600">
                🗓️ Mulai
              </span>
              <span class="font-semibold text-slate-900">
                {{ $room->started_at->format('j M Y, H:i') }}
              </span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-1 font-medium text-slate-600">
                🏁 Selesai
              </span>
              <span class="font-semibold text-slate-900">
                {{ $room->end_at->format('j M Y, H:i') }}
              </span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-1 font-medium text-slate-600">
                👥 Peserta
              </span>
              <span class="font-semibold text-slate-900">
                {{ $room->members_count ?? '0' }} Peserta
              </span>
            </li>
          </ul>
        </div>

      </div>
    </aside>

  </div>
@endsection
