<!-- INI HALAMAN UNTUK MENGEDIT PROFILE (MENTOR) -->
@extends('layouts.mentor')

@section('content')
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <header class="mb-6 md:mb-8">
            <h1 class="text-4xl md:text-4xl font-semibold text-white tracking-tight">
                Edit Profil Mentor
            </h1>
            <p class="mt-2 text-lg text-white">
                Lengkapi bio, pengalaman, dan keahlianmu agar mentee lebih mudah mengenalmu.
            </p>
        </header>

        {{-- Card --}}
        <form action="{{ route('mentor.profile.update', auth()->user()) }}" method="POST"
              class="bg-white/95 border border-slate-100 rounded-2xl shadow-sm p-6 md:p-8 space-y-6">
            @csrf
            @method('PUT')

            @include('partials._form-errors')

            {{-- Bio --}}
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label for="bio" class="text-base font-medium text-slate-800">
                        Bio Singkat
                    </label>
                </div>

                <textarea id="bio" name="bio" rows="4"
                          class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 text-base text-slate-900
                                 shadow-inner focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100
                                 outline-none placeholder:text-slate-400 transition"
                          placeholder="Ceritakan sedikit tentang diri Anda, fokus ke hal yang relevan dengan mentoring...">{{ old('bio', $profile->bio) }}</textarea>
            </div>

            {{-- Experience --}}
            <div class="space-y-2">
                <label for="experience" class="text-base font-medium text-slate-800">
                    Pengalaman
                </label>

                <input type="text" id="experience" name="experience"
                       class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 text-base text-slate-900
                              shadow-inner focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100
                              outline-none placeholder:text-slate-400 transition"
                       value="{{ old('experience', $profile->experience) }}"
                       placeholder="Contoh: 5 tahun sebagai Web Developer, 2 tahun mengajar kelas online">

                <p class="text-sm text-slate-400">
                    Tulis pengalaman yang paling relevan dengan topik mentoring yang kamu ajarkan.
                </p>
            </div>

            {{-- Skills --}}
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label for="skills" class="text-base font-medium text-slate-800">
                        Keahlian
                    </label>
                    @php
                        $mySkillIds = $profile->skills->pluck('id')->toArray();
                        $selectedSkills = count(old('skills', $mySkillIds));
                    @endphp
                    <span class="text-sm text-slate-400">
                        Maksimal 5 keahlian
                        @if($selectedSkills)
                            • <span class="font-semibold text-sky-500">{{ $selectedSkills }}</span> dipilih
                        @endif
                    </span>
                </div>

                <div class="relative">
                    <select name="skills[]" id="skills" multiple
                            class="w-full h-44 rounded-xl border border-slate-300 bg-slate-50 px-4 py-2 text-base text-slate-900
                                   focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-100 outline-none transition
                                   scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-slate-100">
                        @foreach($allSkills as $skill)
                            <option value="{{ $skill->id }}"
                                {{ in_array($skill->id, old('skills', $mySkillIds)) ? 'selected' : '' }}>
                                {{ $skill->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <p class="text-sm text-slate-400">
                    Gunakan <span class="font-semibold">Ctrl</span> (atau <span class="font-semibold">Cmd</span> di Mac) untuk memilih lebih dari satu.
                </p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ url()->previous() }}"
                   class="px-5 py-2.5 rounded-full bg-slate-100 text-xs md:text-base font-medium text-slate-700
                          hover:bg-slate-200 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2.5 rounded-full bg-teal-500 text-xs md:text-base font-semibold text-white shadow-sm
                               hover:bg-teal-600 active:scale-[0.98] transition">
                    Update Profil
                </button>
            </div>
        </form>
    </div>
@endsection
