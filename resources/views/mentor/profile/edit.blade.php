<!-- INI HALAMAN UNTUK MENGEDIT PROFILE (MENTOR) -->
@extends('layouts.mentor')

@section('content')
    <div class="max-w-5xl mx-auto">

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

            @include('layouts.partials._form-errors')

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

        <div class="mx-auto py-10 px-4 sm:px-6 lg:px-0 space-y-8">
        {{-- PAGE HEADER --}}
        <header class="space-y-2">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">
                Pengaturan Akun
            </h1>
            <p class="text-sm text-white max-w-2xl">
                Atur informasi profil, ubah kata sandi, dan kelola keamanan akun ShareRoom milikmu.
            </p>
        </header>

        {{-- GRID: PROFILE INFO + PASSWORD --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
            {{-- PROFILE INFORMATION --}}
            <section
                class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5 sm:p-6">
                <div class="flex items-start gap-3 mb-4">
                    <div class="inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-teal-50 text-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M16 7a4 4 0 11-8 0 4 4 4 0 018 0zM4.75 20a7.25 7.25 0 0114.5 0" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-gray-900">
                            Informasi Profil
                        </h2>
                        <p class="mt-1 text-xs text-gray-500">
                            Perbarui nama dan alamat email yang digunakan untuk akun ini.
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            {{-- UPDATE PASSWORD --}}
            <section
                class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5 sm:p-6">
                <div class="flex items-start gap-3 mb-4">
                    <div class="inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M12 15.5a3 3 0 100-6 3 3 0 000 6z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M17.657 8.343A8 8 0 108.343 17.657 8 8 0 0017.657 8.343z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-gray-900">
                            Ubah Kata Sandi
                        </h2>
                        <p class="mt-1 text-xs text-gray-500">
                            Gunakan kata sandi yang kuat dan sulit ditebak untuk menjaga keamanan akunmu.
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    @include('profile.partials.update-password-form')
                </div>
            </section>
        </div>

        {{-- DELETE ACCOUNT (DANGER ZONE) --}}
        <section class="bg-white border border-rose-100 shadow-sm rounded-2xl p-5 sm:p-6">
            <div class="flex items-start gap-3 mb-3">
                <div class="inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-rose-50 text-rose-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a1.75 1.75 0 001.51 2.62h17.34A1.75 1.75 0 0022.18 18L13.71 3.86a1.75 1.75 0 00-3.42 0z" />
                    </svg>
                </div>
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full bg-rose-50 border border-rose-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-rose-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                        Danger Zone
                    </p>
                    <h2 class="mt-3 text-base font-semibold text-gray-900">
                        Hapus Akun
                    </h2>
                    <p class="mt-1 text-xs text-gray-500">
                        Tindakan ini bersifat permanen. Semua data dan riwayat kamu akan dihapus dan tidak dapat dikembalikan.
                    </p>
                </div>
            </div>

            <div class="border-t border-rose-100 pt-4">
                @include('profile.partials.delete-user-form')
            </div>
        </section>
    </div>
    </div>
@endsection
