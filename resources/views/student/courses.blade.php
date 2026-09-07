@extends('layouts.app')

@section('title', 'Kelas Saya - Sekolah Literasi')

@section('content')

<section class="bg-slate-50 py-12">

    <div class="mx-auto max-w-7xl px-6">

        {{-- Header --}}
        <div class="mb-8">

            <a
                href="{{ route('student.dashboard') }}"
                class="text-sm font-semibold text-blue-600 hover:text-blue-700"
            >
                ← Dashboard
            </a>

            <h1 class="mt-4 text-3xl font-bold text-slate-900">
                Kelas Saya
            </h1>

            <p class="mt-2 text-slate-500">
                Daftar kelas yang sedang dan pernah kamu ikuti.
            </p>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- Error --}}
        @if($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach

            </div>

        @endif


        @forelse($registrations as $registration)

            @php
                $course = $registration->course;
            @endphp

            <div class="mb-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-center">

                    {{-- Course --}}
                    <div>

                        <div class="flex items-center gap-3">

                            @switch($registration->status)

                                @case('registered')
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                        Terdaftar
                                    </span>
                                    @break

                                @case('in_progress')
                                    <span class="rounded-full bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        Sedang Belajar
                                    </span>
                                    @break

                                @case('completed')
                                    <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                        Selesai
                                    </span>
                                    @break

                                @case('cancelled')
                                    <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                        Dibatalkan
                                    </span>
                                    @break

                            @endswitch

                        </div>


                        <h2 class="mt-3 text-xl font-bold text-slate-900">
                            {{ $course->name }}
                        </h2>


                        <div class="mt-3 space-y-1 text-sm text-slate-500">

                            <p>
                                👨‍🏫 Mentor:
                                <span class="font-medium text-slate-700">
                                    {{ $course->mentor ?? '-' }}
                                </span>
                            </p>

                            @if($course->schedule)

                                <p>
                                    📅 Jadwal:
                                    <span class="font-medium text-slate-700">
                                        {{ $course->schedule->format('d M Y, H:i') }}
                                    </span>
                                </p>

                            @endif

                            @if($registration->registered_at)

                                <p>
                                    📝 Terdaftar:
                                    <span class="font-medium text-slate-700">
                                        {{ $registration->registered_at->format('d M Y, H:i') }}
                                    </span>
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-wrap gap-3">

                        <a
                            href="{{ route('courses.show', $course) }}"
                            class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                        >
                            Detail
                        </a>


                        @if(in_array($registration->status, ['registered', 'in_progress']))

                            <form
                                action="{{ route('student.courses.cancel', $registration) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin membatalkan kelas ini?')"
                            >

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700"
                                >
                                    Batalkan
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="rounded-2xl border border-slate-200 bg-white p-12 text-center">

                <div class="text-6xl">
                    🎓
                </div>

                <h2 class="mt-5 text-xl font-bold text-slate-900">
                    Belum Mengikuti Kelas
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                    Kamu belum mendaftar kelas apapun.
                    Yuk mulai belajar dan tingkatkan literasimu!
                </p>

                <a
                    href="{{ route('courses.index') }}"
                    class="mt-6 inline-block rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Jelajahi Kelas
                </a>

            </div>

        @endforelse


        {{-- Pagination --}}
        @if($registrations->hasPages())

            <div class="mt-8">
                {{ $registrations->links() }}
            </div>

        @endif

    </div>

</section>

@endsection