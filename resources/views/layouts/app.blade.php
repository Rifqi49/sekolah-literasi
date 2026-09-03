<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Sekolah Literasi')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- Navbar --}}
    <nav class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <a
                href="{{ route('home') }}"
                class="text-2xl font-bold text-blue-700"
            >
                Sekolah Literasi
            </a>

            <div class="hidden items-center gap-8 md:flex">

                <a
                    href="{{ route('home') }}"
                    class="text-sm font-medium text-slate-700 hover:text-blue-700"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('books.index') }}"
                    class="text-sm font-medium text-slate-700 hover:text-blue-700"
                >
                    Buku
                </a>

                <a
                    href="{{ route('courses.index') }}"
                    class="text-sm font-medium text-slate-700 hover:text-blue-700"
                >
                    Kelas
                </a>

                <a
                    href="#tentang"
                    class="text-sm font-medium text-slate-700 hover:text-blue-700"
                >
                    Tentang
                </a>

            </div>

            <a
                href="/admin"
                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                Login
            </a>

        </div>
    </nav>


    {{-- Content --}}
    <main>
        @yield('content')
    </main>


    {{-- Footer --}}
    <footer class="mt-20 bg-slate-900 text-white">

        <div class="mx-auto max-w-7xl px-6 py-12">

            <div class="grid gap-10 md:grid-cols-3">

                <div>
                    <h2 class="text-xl font-bold">
                        Sekolah Literasi
                    </h2>

                    <p class="mt-4 text-sm leading-6 text-slate-400">
                        Platform literasi untuk membaca buku,
                        mengikuti kelas, dan meningkatkan kemampuan
                        belajar secara berkelanjutan.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold">
                        Navigasi
                    </h3>

                    <div class="mt-4 space-y-2 text-sm text-slate-400">
                        <a href="{{ route('home') }}" class="block hover:text-white">
                            Beranda
                        </a>

                        <a href="{{ route('books.index') }}" class="block hover:text-white">
                            Buku
                        </a>

                        <a href="{{ route('courses.index') }}" class="block hover:text-white">
                            Kelas
                        </a>
                    </div>
                </div>

                <div id="tentang">
                    <h3 class="font-semibold">
                        Sekolah Literasi
                    </h3>

                    <p class="mt-4 text-sm leading-6 text-slate-400">
                        Membaca lebih banyak.
                        Belajar lebih baik.
                        Bertumbuh bersama.
                    </p>
                </div>

            </div>

            <div class="mt-10 border-t border-slate-800 pt-6 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} Sekolah Literasi.
                All rights reserved.
            </div>

        </div>

    </footer>

    @stack('scripts')

</body>
</html>