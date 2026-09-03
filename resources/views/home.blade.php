@extends('layouts.app')

@section('title', 'Beranda - Sekolah Literasi')

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden bg-white">

    <div class="mx-auto max-w-7xl px-6 py-20 lg:py-28">

        <div class="max-w-3xl">

            <span
                class="inline-flex rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700"
            >
                📚 Belajar • Membaca • Bertumbuh
            </span>

            <h1
                class="mt-6 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl"
            >
                Bangun Budaya Literasi,
                <span class="text-blue-600">
                    Mulai dari Sekarang.
                </span>
            </h1>

            <p
                class="mt-6 max-w-2xl text-lg leading-8 text-slate-600"
            >
                Temukan berbagai buku untuk dibaca dan ikuti
                kelas pembelajaran yang membantu meningkatkan
                kemampuan literasi kamu.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">

                <a
                    href="{{ route('books.index') }}"
                    class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    Jelajahi Buku
                </a>

                <a
                    href="{{ route('courses.index') }}"
                    class="rounded-lg border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Lihat Kelas
                </a>

            </div>

        </div>

    </div>

</section>


{{-- Books --}}
<section class="bg-slate-50 py-20">

    <div class="mx-auto max-w-7xl px-6">

        <div class="flex items-end justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Perpustakaan
                </p>

                <h2 class="mt-2 text-3xl font-bold text-slate-900">
                    Buku Pilihan
                </h2>

                <p class="mt-3 text-slate-600">
                    Temukan buku yang menarik untuk dibaca.
                </p>
            </div>

            <a
                href="{{ route('books.index') }}"
                class="hidden text-sm font-semibold text-blue-600 hover:text-blue-700 sm:block"
            >
                Lihat Semua →
            </a>

        </div>


        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($books as $book)

                <article
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    @if($book->cover)

                        <img
                            src="{{ asset('storage/' . $book->cover) }}"
                            alt="{{ $book->title }}"
                            class="h-56 w-full object-cover"
                        >

                    @else

                        <div class="flex h-56 items-center justify-center bg-slate-100">
                            <span class="text-5xl">📖</span>
                        </div>

                    @endif


                    <div class="p-6">

                        @if($book->category)
                            <span class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                                {{ $book->category->name }}
                            </span>
                        @endif

                        <h3 class="mt-2 text-xl font-bold text-slate-900">
                            {{ $book->title }}
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            {{ $book->author ?? 'Penulis tidak tersedia' }}
                        </p>

                        <a
                            href="{{ route('books.show', $book) }}"
                            class="mt-5 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700"
                        >
                            Lihat Detail →
                        </a>

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-xl bg-white p-10 text-center">
                    <p class="text-slate-500">
                        Belum ada buku tersedia.
                    </p>
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- Courses --}}
<section class="bg-white py-20">

    <div class="mx-auto max-w-7xl px-6">

        <div class="max-w-2xl">

            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                Pembelajaran
            </p>

            <h2 class="mt-2 text-3xl font-bold text-slate-900">
                Kelas Literasi
            </h2>

            <p class="mt-3 text-slate-600">
                Tingkatkan kemampuanmu melalui kelas yang tersedia.
            </p>

        </div>


        <div class="mt-10 grid gap-6 md:grid-cols-3">

            @forelse($courses as $course)

                <article
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                        🎓
                    </div>

                    <h3 class="mt-5 text-xl font-bold text-slate-900">
                        {{ $course->name }}
                    </h3>

                    <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">
                        {{ $course->description }}
                    </p>

                    <div class="mt-5 text-sm text-slate-500">
                        Mentor:
                        <span class="font-medium text-slate-700">
                            {{ $course->mentor }}
                        </span>
                    </div>

                    <a
                        href="{{ route('courses.show', $course) }}"
                        class="mt-5 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700"
                    >
                        Lihat Kelas →
                    </a>

                </article>

            @empty

                <div class="col-span-full rounded-xl bg-slate-50 p-10 text-center">
                    <p class="text-slate-500">
                        Belum ada kelas aktif.
                    </p>
                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection