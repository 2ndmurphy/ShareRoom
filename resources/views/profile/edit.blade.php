   @extends('layouts.learner')
   
   @section('content')
    
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

    @endsection