<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Shareroom – Belajar dari Kelas Terbaik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-30 bg-white border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('images/icons/shareroom-icon.webp') }}" alt="Shareroom logo"
                     class="w-12 h-12 object-contain">
                <span class="font-semibold text-xl tracking-tight">
                    Share<span class="text-teal-500">room</span>
                </span>
            </a>

            {{-- Menu --}}
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="#features" class="hover:text-teal-500">Fitur</a>
                <a href="#how-it-works" class="hover:text-teal-500">Cara Kerja</a>
                <a href="#categories" class="hover:text-teal-500">Kategori</a>
                <a href="#cta" class="hover:text-teal-500">Mulai</a>
            </nav>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('login') }}"
                   class="hidden sm:inline-block px-4 py-2 rounded-full border border-slate-300 hover:border-teal-400 hover:text-teal-500 transition">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                   class="inline-flex items-center px-4 py-2 rounded-full bg-teal-400 text-white font-semibold shadow-sm hover:bg-teal-500 transition">
                    Daftar Gratis
                </a>
            </div>
        </div>
    </header>


    <main>
        {{-- HERO SECTION --}}
        <section class="bg-gradient-to-br from-teal-400 via-teal-500 to-sky-500 text-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 grid lg:grid-cols-2 gap-10 items-center">

                {{-- Text --}}
                <div>
                    <p class="uppercase text-xs tracking-[0.3em] text-white/80 mb-3">
                        belajar bareng komunitas
                    </p>

                    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">
                        Temukan & buka kelas belajar
                        <span class="text-sky-100">di satu ruangan digital.</span>
                    </h1>

                    <p class="mt-6 text-sm sm:text-base text-white/90 max-w-xl leading-relaxed">
                        Shareroom adalah platform untuk membuka dan mengikuti kelas pembelajaran.
                        Creator bisa membuat kelas, peserta bisa bergabung dan belajar bersama kapan saja.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-6 py-3 rounded-full bg-white text-teal-600 font-semibold shadow-lg shadow-teal-900/20 hover:bg-slate-50 transition">
                            Mulai Buat Akun
                        </a>

                        <a href="#features"
                           class="inline-flex items-center text-sm font-medium text-white/90 hover:text-white">
                            Lihat bagaimana Shareroom bekerja →
                        </a>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-6 text-xs text-white/90">
                        <div>
                            <p class="font-semibold text-base">+500</p>
                            <p>Kelas yang aktif</p>
                        </div>
                        <div>
                            <p class="font-semibold text-base">+2.000</p>
                            <p>Peserta belajar</p>
                        </div>
                        <div>
                            <p class="font-semibold text-base">24/7</p>
                            <p>Akses materi online</p>
                        </div>
                    </div>
                </div>


                {{-- Illustration Card --}}
                <div class="relative">
                    <div class="absolute -top-6 -right-6 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-4 w-28 h-28 bg-teal-300/40 rounded-full blur-2xl"></div>

                    <div class="relative bg-white rounded-3xl shadow-2xl shadow-teal-900/20 p-5 sm:p-6">
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-xs font-medium text-slate-500">Kelas sedang berlangsung</p>
                                <p class="text-sm font-semibold text-slate-900 mt-1">UI/UX Design for Beginner</p>
                            </div>

                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-teal-50 text-teal-600 text-[11px] font-medium">
                                32 peserta
                            </span>
                        </div>

                        <div class="aspect-video rounded-2xl overflow-hidden bg-slate-100 mb-4">
                            <img src="https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg"
                                 class="w-full h-full object-cover">
                        </div>

                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <div class="flex -space-x-2">
                                <img class="w-7 h-7 rounded-full border-2 border-white" src="https://i.pravatar.cc/40?img=4">
                                <img class="w-7 h-7 rounded-full border-2 border-white" src="https://i.pravatar.cc/40?img=5">
                                <img class="w-7 h-7 rounded-full border-2 border-white" src="https://i.pravatar.cc/40?img=6">
                            </div>
                            <p>Mulai jam 19.00 WIB · Zoom & Rekaman</p>
                        </div>

                    </div>
                </div>

            </div>
        </section>


        {{-- FEATURES --}}
        <section id="features" class="py-14 sm:py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="text-center mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">
                        Semua yang kamu butuhkan untuk <span class="text-teal-600">belajar dan mengajar</span>
                    </h2>
                    <p class="mt-3 text-sm text-slate-500 max-w-2xl mx-auto">
                        Shareroom menghubungkan mentor dan learner dalam satu ruang yang rapi.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">

                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center mb-4">
                            <span class="text-xl">📚</span>
                        </div>
                        <h3 class="font-semibold mb-2">Kelola kelas dengan mudah</h3>
                        <p class="text-sm text-slate-500">
                            Buat halaman kelas, atur kurikulum, dan jadwal hanya dalam beberapa klik.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center mb-4">
                            <span class="text-xl">👥</span>
                        </div>
                        <h3 class="font-semibold mb-2">Peserta bisa join kapan saja</h3>
                        <p class="text-sm text-slate-500">
                            Pengguna bisa mencari topik yang diminati dan langsung ikut kelas.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center mb-4">
                            <span class="text-xl">🎧</span>
                        </div>
                        <h3 class="font-semibold mb-2">Format fleksibel</h3>
                        <p class="text-sm text-slate-500">
                            Live session, rekaman video, tugas, diskusi, atau kombinasi semuanya.
                        </p>
                    </div>

                </div>

            </div>
        </section>


        {{-- HOW IT WORKS --}}
        <section id="how-it-works" class="py-14 sm:py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center">

                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold mb-4">
                        Cara kerja Shareroom untuk <span class="text-teal-600">mentor & peserta</span>
                    </h2>

                    <p class="text-sm text-slate-500 mb-6">
                        Satu platform untuk dua kebutuhan: mengajar dan belajar.
                    </p>

                    <ol class="space-y-4 text-sm text-slate-600">
                        <li class="flex gap-3">
                            <span class="w-7 h-7 rounded-full bg-teal-400 text-white flex items-center justify-center text-xs font-semibold">1</span>
                            <div>
                                <p class="font-semibold">Buat akun sebagai mentor atau peserta</p>
                                <p class="text-xs text-slate-500 mt-1">Daftar menggunakan email dan pilih peranmu.</p>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-7 h-7 rounded-full bg-teal-400 text-white flex items-center justify-center text-xs font-semibold">2</span>
                            <div>
                                <p class="font-semibold">Buka kelas atau pilih kelas</p>
                                <p class="text-xs text-slate-500 mt-1">Mentor membuat kelas, peserta memilih kelas.</p>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-7 h-7 rounded-full bg-teal-400 text-white flex items-center justify-center text-xs font-semibold">3</span>
                            <div>
                                <p class="font-semibold">Belajar bareng</p>
                                <p class="text-xs text-slate-500 mt-1">Ikuti sesi, akses materi, dan berdiskusi.</p>
                            </div>
                        </li>
                    </ol>
                </div>


                {{-- Example Classes --}}
                <div class="bg-slate-50 border border-dashed border-teal-300 rounded-3xl p-6 sm:p-8">
                    <p class="text-xs font-semibold text-teal-600 uppercase tracking-[0.25em] mb-2">
                        contoh kelas
                    </p>
                    <h3 class="text-lg font-semibold mb-4">Kelas populer di Shareroom</h3>

                    <div class="space-y-4 text-sm">

                        <div class="flex justify-between items-center bg-white rounded-2xl px-4 py-3 border border-slate-100">
                            <div>
                                <p class="font-semibold">Front-end Web Development 101</p>
                                <p class="text-[11px] text-slate-500 mt-1">HTML · CSS · Tailwind · JS</p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-teal-50 text-teal-600">Beginner</span>
                        </div>

                        <div class="flex justify-between items-center bg-white rounded-2xl px-4 py-3 border border-slate-100">
                            <div>
                                <p class="font-semibold">Productive Note-taking with Notion</p>
                                <p class="text-[11px] text-slate-500 mt-1">Workshop · Template · Q&A</p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-sky-50 text-sky-600">Workshop</span>
                        </div>

                        <div class="flex justify-between items-center bg-white rounded-2xl px-4 py-3 border border-slate-100">
                            <div>
                                <p class="font-semibold">Belajar Public Speaking dari Nol</p>
                                <p class="text-[11px] text-slate-500 mt-1">3 sesi · Rekaman materi</p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-teal-50 text-teal-600">Soft Skill</span>
                        </div>

                    </div>
                </div>

            </div>
        </section>


        {{-- CATEGORIES --}}
        <section id="categories" class="py-14 sm:py-16 bg-slate-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">Kategori Kelas di Shareroom</h2>
                    <a href="#cta" class="text-sm text-teal-600 hover:text-teal-700 font-medium">
                        Lihat semua kelas →
                    </a>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">

                    <div class="bg-white rounded-2xl border border-slate-100 p-4 flex flex-col gap-1">
                        <span class="text-xl mb-1">💻</span>
                        <p class="font-semibold">Teknologi & Programming</p>
                        <p class="text-xs text-slate-500">Web dev, mobile, data, dsb.</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 p-4 flex flex-col gap-1">
                        <span class="text-xl mb-1">🎨</span>
                        <p class="font-semibold">Desain & Kreatif</p>
                        <p class="text-xs text-slate-500">UI/UX, ilustrasi, fotografi.</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 p-4 flex flex-col gap-1">
                        <span class="text-xl mb-1">📈</span>
                        <p class="font-semibold">Bisnis & Produktivitas</p>
                        <p class="text-xs text-slate-500">Branding, marketing, time mgmt.</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 p-4 flex flex-col gap-1">
                        <span class="text-xl mb-1">🌱</span>
                        <p class="font-semibold">Pengembangan Diri</p>
                        <p class="text-xs text-slate-500">Soft skill, komunikasi.</p>
                    </div>

                </div>

            </div>
        </section>


        {{-- CTA --}}
        <section id="cta" class="py-16 bg-teal-400 text-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

                <h2 class="text-3xl font-extrabold mb-3">
                    Siap membuka atau mengikuti kelas pertamamu?
                </h2>

                <p class="text-sm sm:text-base text-white/90 max-w-2xl mx-auto mb-8">
                    Buat akun gratis di Shareroom, mulai bangun kelas pembelajaranmu,
                    dan ajak orang lain untuk belajar bersama.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">

                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-7 py-3 rounded-full bg-white text-teal-600 font-semibold shadow-lg hover:bg-slate-50 transition">
                        Daftar sebagai Mentor
                    </a>

                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-6 py-3 rounded-full border border-teal-100 text-sm font-medium text-white hover:bg-teal-300/60 transition">
                        Daftar sebagai Peserta
                    </a>

                </div>

            </div>
        </section>

    </main>


    {{-- FOOTER --}}
    <footer class="border-t border-slate-100 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500">
            <p>© {{ date('Y') }} Shareroom. All rights reserved.</p>

            <div class="flex gap-4">
                <a href="#" class="hover:text-teal-600">Kebijakan Privasi</a>
                <a href="#" class="hover:text-teal-600">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

</body>
</html>
