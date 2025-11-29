<div class="bg-white rounded-[30px] shadow-md p-6 flex flex-col justify-between h-full">
    {{-- HEADER: LOGO + NAMA ROOM --}}
    <div class="space-y-4">
        <div class="flex items-center gap-3">
            {{-- “logo” kotak ijo dengan inisial --}}
            <div class="h-11 w-11 rounded-2xl bg-teal-500 flex items-center justify-center">
                <span class="text-white text-sm font-semibold">
                    {{ strtoupper(substr($room->title, 0, 2)) }}
                </span>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 leading-tight">
                    {{ $room->title }}
                </h3>
                <p class="text-[11px] text-gray-500 mt-0.5">
                    {{ $room->roomType->name }}
                </p>
            </div>
        </div>

        {{-- MINI MENU (Workshop, Bootcamp, dll) --}}
        <div class="flex flex-wrap gap-4 text-[11px] font-medium text-gray-500">
            <span>Workshop</span>
            <span>Bootcamp</span>
            <span>Projek</span>
            <span>Diskusi</span>
        </div>

        {{-- DESKRIPSI --}}
        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
            {{ $room->description }}
        </p>
    </div>

    {{-- FOOTER: BUTTON + STATUS --}}
    <div class="mt-5 flex items-center justify-between gap-3">
        <a href="{{ route('mentor.rooms.show', $room) }}"
           class="inline-flex items-center justify-center px-5 py-2.5 rounded-full
                  bg-teal-500 hover:bg-teal-600 text-white text-sm font-semibold
                  transition duration-200 shadow-sm">
            Manage Room
        </a>

        <div>
            @if($room->status == 'open')
                <span
                    class="px-3 py-1 inline-flex text-[11px] leading-5 font-semibold rounded-full
                           border border-emerald-200 bg-emerald-50 text-emerald-700">
                    Dibuka
                </span>
            @elseif($room->status == 'closed')
                <span
                    class="px-3 py-1 inline-flex text-[11px] leading-5 font-semibold rounded-full
                           border border-rose-200 bg-rose-50 text-rose-700">
                    Ditutup
                </span>
            @else
                <span
                    class="px-3 py-1 inline-flex text-[11px] leading-5 font-semibold rounded-full
                           border border-amber-200 bg-amber-50 text-amber-700">
                    Selesai
                </span>
            @endif
        </div>
    </div>
</div>
