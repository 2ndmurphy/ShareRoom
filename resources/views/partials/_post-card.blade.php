<article
  class="group overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-md">

  <div class="p-6 sm:p-8">

    {{-- USER HEADER --}}
    <div class="mb-6 flex items-center gap-4">
      <img alt="{{ $post->user->name }}'s avatar" class="h-11 w-11 rounded-full object-cover shadow ring-2 ring-white"
        src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random&color=fff">

      <div>
        <p class="text-sm font-semibold text-slate-900">
          {{ $post->user->name }}
        </p>
        <p class="text-xs text-slate-500">
          {{ $post->created_at->format('j M Y') }} ·
          <span class="text-slate-400">{{ $post->created_at->diffForHumans() }}</span>
        </p>
      </div>
    </div>

    {{-- TITLE + CONTENT --}}
    <div>
      <h2 class="mb-2 text-xl font-bold leading-tight text-slate-900 transition group-hover:text-teal-600 md:text-2xl">
        {{ $post->title }}
      </h2>

      <p class="mb-5 line-clamp-3 text-sm leading-relaxed text-slate-700 md:text-base">
        {{ $post->content }}
      </p>
    </div>

    {{-- BOTTOM AREA --}}
    <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

      {{-- Room Info --}}
      <div>
        <div class="flex items-center gap-3">
          <span
            class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
            {{ $post->room->roomType->name }}
          </span>

          <span class="text-sm font-semibold text-slate-800">
            {{ $post->room->title }}
          </span>
        </div>
      </div>

      {{-- Button --}}
      <a class="inline-flex items-center justify-center gap-2 rounded-full bg-teal-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2"
        href="{{ route('explore.room.show', $post->room) }}">

        <span>Lihat Detail Room</span>

        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
        </svg>
      </a>

    </div>

  </div>
</article>
