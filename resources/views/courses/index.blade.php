@extends('layouts.app')

@section('title', 'Kelas - Sekolah Literasi')

@section('content')

{{-- Hero --}}
<section class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-6 py-14">

        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
            Program Literasi
        </p>

        <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-900">
            Kelas Literasi
        </h1>

        <p class="mt-4 max-w-2xl text-slate-600">
            Ikuti berbagai kelas untuk meningkatkan kemampuan membaca,
            menulis, berpikir kritis, dan memahami informasi digital.
        </p>

    </div>
</section>


{{-- Courses --}}
<section class="bg-slate-50 py-12">

    <div class="mx-auto max-w-7xl px-6">

        <div class="mb-8 flex items-end justify-between">

            <div>
                <h2 class="text-2xl font-bold text-slate-900">
                    Pilihan Kelas
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Temukan kelas yang sesuai dengan kebutuhan belajar kamu.
                </p>
            </div>

        </div>


        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            @forelse($courses as $course)

                <article
                    class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg"
                >

                    {{-- Header Card --}}
                    <div class="flex h-40 items-center justify-center bg-gradient-to-br from-blue-600 to-indigo-700">

                        <span class="text-7xl">
                            🎓
                        </span>

                    </div>


                    {{-- Content --}}
                    <div class="p-6">

                        <div class="flex items-center justify-between gap-3">

                            @if($course->is_active)

                                <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                    Aktif
                                </span>

                            @else

                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                    Tidak Aktif
                                </span>

                            @endif

                            <span class="text-xs text-slate-400">
                                Kuota {{ $course->quota }}
                            </span>

                        </div>


                        <h3 class="mt-4 line-clamp-2 text-xl font-bold text-slate-900">
                            {{ $course->name }}
                        </h3>


                        @if($course->description)

                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">
                                {{ $course->description }}
                            </p>

                        @endif


                        {{-- Mentor --}}
                        <div class="mt-5 flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-sm">
                                👨‍🏫
                            </div>

                            <div>

                                <p class="text-xs text-slate-400">
                                    Mentor
                                </p>

                                <p class="text-sm font-semibold text-slate-700">
                                    {{ $course->mentor ?? 'Belum ditentukan' }}
                                </p>

                            </div>

                        </div>


                        {{-- Schedule --}}
                        @if($course->schedule)

                            <div class="mt-4 flex items-center gap-2 text-sm text-slate-500">

                                <span>📅</span>

                                <span>
                                    {{ $course->schedule->format('d M Y, H:i') }}
                                </span>

                            </div>

                        @endif


                        {{-- Quota --}}
                        @if(method_exists($course, 'remainingQuota'))

                            <div class="mt-5">

                                <div class="mb-2 flex justify-between text-xs">

                                    <span class="text-slate-500">
                                        Sisa kuota
                                    </span>

                                    <span class="font-semibold text-slate-700">
                                        {{ $course->remainingQuota() }}
                                    </span>

                                </div>

                                <div class="h-2 overflow-hidden rounded-full bg-slate-100">

                                    @php
                                        $percentage = $course->quota > 0
                                            ? (($course->quota - $course->remainingQuota()) / $course->quota) * 100
                                            : 0;
                                    @endphp

                                    <div
                                        class="h-full rounded-full bg-blue-600"
                                        style="width: {{ min(100, $percentage) }}%"
                                    ></div>

                                </div>

                            </div>

                        @endif


                        {{-- Detail --}}
                        <a
                            href="{{ route('courses.show', $course) }}"
                            class="mt-6 block rounded-lg bg-blue-600 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-blue-700"
                        >
                            Lihat Detail Kelas
                        </a>

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-2xl border border-slate-200 bg-white p-12 text-center">

                    <div class="text-5xl">
                        🎓
                    </div>

                    <h2 class="mt-4 text-xl font-bold text-slate-900">
                        Belum Ada Kelas
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Saat ini belum tersedia kelas yang dapat diikuti.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($courses->hasPages())

            <div class="mt-10">
                {{ $courses->links() }}
            </div>

        @endif

    </div>

</section>

@endsection