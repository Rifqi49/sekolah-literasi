@extends('layouts.app')

@section('title', $course->name . ' - Sekolah Literasi')

@section('content')

<section class="bg-slate-50 py-14">

    <div class="mx-auto max-w-6xl px-6">

        {{-- Back --}}
        <a
            href="{{ route('courses.index') }}"
            class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700"
        >
            ← Kembali ke Kelas
        </a>


        <div class="mt-8 grid gap-10 lg:grid-cols-3">

            {{-- Course Visual --}}
            <div>

                <div class="flex aspect-video items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 shadow-lg">

                    <span class="text-8xl">
                        🎓
                    </span>

                </div>

            </div>


            {{-- Information --}}
            <div class="lg:col-span-2">

                @if($course->is_active)

                    <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                        Kelas Aktif
                    </span>

                @else

                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                        Kelas Tidak Aktif
                    </span>

                @endif


                <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900">
                    {{ $course->name }}
                </h1>


                @if($course->description)

                    <p class="mt-5 leading-8 text-slate-600">
                        {{ $course->description }}
                    </p>

                @endif


                {{-- Information --}}
                <div class="mt-8 grid gap-4 sm:grid-cols-2">

                    <div class="rounded-xl border border-slate-200 bg-white p-5">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Mentor
                        </p>

                        <p class="mt-2 font-semibold text-slate-800">
                            👨‍🏫 {{ $course->mentor ?? '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl border border-slate-200 bg-white p-5">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Jadwal
                        </p>

                        <p class="mt-2 font-semibold text-slate-800">

                            @if($course->schedule)
                                📅 {{ $course->schedule->format('d M Y, H:i') }}
                            @else
                                -
                            @endif

                        </p>

                    </div>


                    <div class="rounded-xl border border-slate-200 bg-white p-5">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Kuota
                        </p>

                        <p class="mt-2 font-semibold text-slate-800">
                            {{ $course->quota }} Peserta
                        </p>

                    </div>


                    <div class="rounded-xl border border-slate-200 bg-white p-5">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Sudah Terdaftar
                        </p>

                        <p class="mt-2 font-semibold text-slate-800">
                            {{ $course->registered_count }} Peserta
                        </p>

                    </div>

                </div>


                {{-- Registration --}}
                <div class="mt-8 rounded-2xl border border-blue-100 bg-blue-50 p-6">

                    @if($course->isAvailable())

                        <h2 class="text-lg font-bold text-slate-900">
                            Tertarik mengikuti kelas ini?
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Daftarkan diri kamu untuk mengikuti kelas
                            {{ $course->name }}.
                        </p>

                    @auth

                        @php
                            $alreadyRegistered = auth()->user()
                                ->courseRegistrations()
                                ->where('course_id', $course->id)
                                ->exists();
                        @endphp

                        @if(auth()->user()->isStudent())

                            @if($alreadyRegistered)

                                <div class="mt-5">

                                    <div class="rounded-lg bg-green-50 px-5 py-3 text-sm font-semibold text-green-700">
                                        ✓ Kamu sudah terdaftar di kelas ini.
                                    </div>

                                    <a
                                        href="{{ route('student.courses') }}"
                                        class="mt-3 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700"
                                    >
                                        Lihat Kelas Saya →
                                    </a>

                                </div>

                            @elseif($course->isAvailable())

                                <form
                                    action="{{ route('courses.register', $course) }}"
                                    method="POST"
                                    class="mt-5"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                    >
                                        Daftar Kelas
                                    </button>

                                </form>

                            @else

                                <div class="mt-5 rounded-lg bg-red-50 px-5 py-3 text-sm font-semibold text-red-700">
                                    Kuota kelas sudah penuh.
                                </div>

                            @endif

                        @else

                            <div class="mt-5 rounded-lg bg-slate-100 px-5 py-3 text-sm text-slate-600">
                                Akun admin tidak dapat mendaftar sebagai peserta kelas.
                            </div>

                        @endif

                    @else

                        <div class="mt-5">  

                            <a
                                href="{{ route('login') }}"
                                class="inline-block rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                            >
                                Login untuk Mendaftar
                            </a>

                            <p class="mt-3 text-xs text-slate-500">
                                Belum punya akun?
                                <a
                                    href="{{ route('register') }}"
                                    class="font-semibold text-blue-600"
                                >
                                    Daftar sebagai student
                                </a>
                            </p>

                        </div>

                    @endauth

                    @else

                        <h2 class="text-lg font-bold text-slate-900">
                            Kelas Tidak Tersedia
                        </h2>

                        <p class="mt-2 text-sm text-slate-600">
                            Kuota kelas ini sudah penuh atau kelas sedang tidak aktif.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

@endsection