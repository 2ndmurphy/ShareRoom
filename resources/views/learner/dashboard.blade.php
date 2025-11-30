@extends('layouts.learner')

@section('content')
      {{-- WRAPPER --}}


          {{-- HEADER --}}
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <div>
              <h3 class="text-2xl md:text-3xl font-bold text-white">
                Room yang Saya Ikuti
              </h3>
              <p class="mt-1 text-sm text-white">
                Lanjutkan perjalanan belajarmu di room yang sudah kamu gabung bersama para mentor.
              </p>
            </div>

            @if($joinedRooms->count())
              <span class="inline-flex items-center gap-2 rounded-full bg-teal-50 px-4 py-1.5 text-xs font-semibold text-teal-700 border border-teal-100">
                <span class="h-2 w-2 rounded-full bg-teal-500"></span>
                {{ $joinedRooms->count() }} room aktif diikuti
              </span>
            @endif
          </div>

          {{-- GRID ROOM --}}
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

            @forelse ($joinedRooms as $room)
              <article
                class="flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm
                       hover:shadow-lg hover:border-indigo-200 transition-all duration-200 group">

                {{-- BODY --}}
                <div class="p-5 md:p-6 space-y-3">

                  {{-- Badge tipe + mungkin mode --}}
                  <div class="flex flex-wrap items-center gap-2">
                    <span
                      class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                      {{ $room->roomType->name }}
                    </span>

                    @if(!empty($room->mode))
                      <span
                        class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-[11px] font-medium text-slate-600 capitalize">
                        💻 {{ $room->mode }}
                      </span>
                    @endif
                  </div>

                  {{-- Judul --}}
                  <h4 class="text-lg md:text-xl font-semibold text-slate-900 group-hover:text-indigo-700 line-clamp-2">
                    {{ $room->title }}
                  </h4>

                  {{-- Mentor --}}
                  <p class="text-xs font-medium text-slate-500">
                    oleh <span class="text-slate-700">{{ $room->mentor->name }}</span>
                  </p>

                  {{-- Optional: Jadwal kalau ada --}}
                  @if(!empty($room->started_at) || !empty($room->end_at))
                    <div class="mt-2 space-y-1 text-xs text-slate-500">
                      @if(!empty($room->started_at))
                        <p class="flex items-center gap-2">
                          <span class="text-slate-400">🗓️ Mulai</span>
                          <span class="font-medium text-slate-700">
                            {{ \Illuminate\Support\Carbon::parse($room->started_at)->format('j M Y, H:i') }}
                          </span>
                        </p>
                      @endif

                      @if(!empty($room->end_at))
                        <p class="flex items-center gap-2">
                          <span class="text-slate-400">🏁 Selesai</span>
                          <span class="font-medium text-slate-700">
                            {{ \Illuminate\Support\Carbon::parse($room->end_at)->format('j M Y, H:i') }}
                          </span>
                        </p>
                      @endif
                    </div>
                  @endif

                </div>

                {{-- FOOTER / BUTTON --}}
                <div class="bg-slate-50 px-5 py-4 md:px-6">
                  <a href="{{ route('learner.rooms.show', $room) }}"
                     class="inline-flex w-full items-center justify-center gap-2 rounded-xl
                            bg-teal-400 px-4 py-2.5 text-sm font-semibold text-white
                            shadow-sm hover:bg-teal-700 hover:shadow-md
                            focus:outline-none focus:ring-2 focus:ring-teal-400/70 focus:ring-offset-1
                            transition-all">
                    <span>Masuk Kelas</span>
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>
                  </a>
                </div>

              </article>

            @empty
              {{-- EMPTY STATE --}}
              <div class="md:col-span-2 lg:col-span-3 py-12 flex flex-col items-center justify-center text-center">
                <div
                  class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-teal-50 text-teal-500 border border-teal-100">
                  <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                       viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M3 10v6l9 5 9-5v-6" />
                  </svg>
                </div>

                <p class="mb-1 text-base font-semibold text-slate-800">
                  Anda belum bergabung dengan room manapun.
                </p>
                <p class="mb-5 text-sm text-slate-500 max-w-md">
                  Mulai belajar hal baru dengan bergabung ke room yang dibuka para mentor di ShareRoom.
                </p>

                <a href="{{ route('explore.index') }}"
                   class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-5 py-2.5 text-sm font-semibold text-white
                          shadow-sm hover:bg-emerald-600 hover:shadow-md transition-all">
                  Jelajahi Room Baru
                  <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                       viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              </div>
            @endforelse

          </div>
@endsection
