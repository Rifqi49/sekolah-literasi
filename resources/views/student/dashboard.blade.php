@extends('layouts.app')

@section('title', 'Dashboard Student - Sekolah Literasi')

@section('content')

<section class="bg-slate-50 py-12">

    <div class="mx-auto max-w-7xl px-6">

        {{-- Welcome --}}
        <div class="rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">

            <p class="text-sm font-medium text-blue-100">
                Dashboard Student
            </p>

            <h1 class="mt-2 text-3xl font-bold">
                Halo, {{ auth()->user()->name }}! 👋
            </h1>

            <p class="mt-3 max-w-2xl text-blue-100">
                Selamat datang di ruang belajar Sekolah Literasi.
                Lanjutkan perjalanan literasimu hari ini.
            </p>

        </div>


        {{-- Statistics --}}
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm text-slate-500">
                    Kelas Diikuti
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ auth()->user()->courseRegistrations()->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm text-slate-500">
                    Kelas Aktif
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ auth()->user()->courseRegistrations()->whereIn('status', ['registered', 'in_progress'])->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm text-slate-500">
                    Kelas Selesai
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ auth()->user()->courseRegistrations()->where('status', 'completed')->count() }}
                </p>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="mt-10">

            <h2 class="text-2xl font-bold text-slate-900">
                Mulai Belajar
            </h2>

            <div class="mt-5 grid gap-5 md:grid-cols-2">

                <a
                    href="{{ route('courses.index') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="text-4xl">
                        🎓
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-slate-900">
                        Jelajahi Kelas
                    </h3>
                    
                    <a
                        href="{{ route('student.courses') }}"
                        class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                    >

                        <div class="text-4xl">
                            🎓
                        </div>

                        <h3 class="mt-4 text-lg font-bold text-slate-900">
                            Kelas Saya
                        </h3>

                    </a>

                    <p class="mt-2 text-sm text-slate-500">
                        Lihat kelas yang sedang kamu ikuti dan perkembangan belajarmu.
                    </p>

                    <p class="mt-4 text-sm font-semibold text-blue-600">
                        Lihat Kelas Saya →
                    </p>

                </a>

                <a
                    href="{{ route('books.index') }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="text-4xl">
                        📚
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-slate-900">
                        Baca Buku
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Temukan buku dan bacaan untuk meningkatkan wawasan.
                    </p>

                    <p class="mt-4 text-sm font-semibold text-blue-600">
                        Jelajahi Buku →
                    </p>

                </a>

            </div>

        </div>

    </div>

</section>

@endsection