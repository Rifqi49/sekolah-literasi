@extends('layouts.app')

@section('title', 'Buku - Sekolah Literasi')

@section('content')

{{-- Header --}}
<section class="bg-white border-b border-slate-200">
    <div class="mx-auto max-w-7xl px-6 py-14">

        <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
            Perpustakaan
        </p>

        <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-900">
            Jelajahi Buku
        </h1>

        <p class="mt-4 max-w-2xl text-slate-600">
            Temukan berbagai buku yang dapat membantu memperluas
            wawasan dan meningkatkan kemampuan literasi.
        </p>

    </div>
</section>


{{-- Content --}}
<section class="bg-slate-50 py-12">

    <div class="mx-auto max-w-7xl px-6">

        {{-- Search & Filter --}}
        <form
            action="{{ route('books.index') }}"
            method="GET"
            class="mb-10 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
        >

            <div class="grid gap-4 md:grid-cols-3">

                {{-- Search --}}
                <div class="md:col-span-2">

                    <label
                        for="search"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Cari Buku
                    </label>

                    <input
                        type="text"
                        name="search"
                        id="search"
                        value="{{ request('search') }}"
                        placeholder="Cari berdasarkan judul buku..."
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>


                {{-- Category --}}
                <div>

                    <label
                        for="category"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Kategori
                    </label>

                    <select
                        name="category"
                        id="category"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(request('category') == $category->id)
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="mt-4 flex flex-wrap gap-3">

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    🔍 Cari Buku
                </button>

                <a
                    href="{{ route('books.index') }}"
                    class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Reset
                </a>

            </div>

        </form>


        {{-- Result Information --}}
        <div class="mb-6 flex items-center justify-between">

            <p class="text-sm text-slate-500">
                Menampilkan
                <span class="font-semibold text-slate-700">
                    {{ $books->total() }}
                </span>
                buku
            </p>

            @if(request('search') || request('category'))

                <p class="text-sm text-slate-500">
                    Filter aktif
                </p>

            @endif

        </div>


        {{-- Books --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @forelse($books as $book)

                <article
                    class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg"
                >

                    {{-- Cover --}}
                    <a href="{{ route('books.show', $book) }}">

                        @if($book->cover)

                            <img
                                src="{{ asset('storage/' . $book->cover) }}"
                                alt="{{ $book->title }}"
                                class="h-64 w-full object-cover transition duration-300 group-hover:scale-105"
                            >

                        @else

                            <div class="flex h-64 items-center justify-center bg-slate-100">
                                <span class="text-6xl">
                                    📖
                                </span>
                            </div>

                        @endif

                    </a>


                    {{-- Content --}}
                    <div class="p-5">

                        {{-- Category --}}
                        @if($book->category)

                            <span class="text-xs font-semibold uppercase tracking-wide text-blue-600">
                                {{ $book->category->name }}
                            </span>

                        @endif


                        {{-- Title --}}
                        <h2 class="mt-2 line-clamp-2 text-lg font-bold text-slate-900">
                            {{ $book->title }}
                        </h2>


                        {{-- Author --}}
                        <p class="mt-2 text-sm text-slate-500">
                            {{ $book->author ?? 'Penulis tidak tersedia' }}
                        </p>


                        {{-- Availability --}}
                        <div class="mt-4">

                            @if($book->is_available)

                                <span class="inline-flex rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                    ✓ Tersedia
                                </span>

                            @else

                                <span class="inline-flex rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                    Tidak tersedia
                                </span>

                            @endif

                        </div>


                        {{-- Detail --}}
                        <a
                            href="{{ route('books.show', $book) }}"
                            class="mt-5 block text-sm font-semibold text-blue-600 transition hover:text-blue-700"
                        >
                            Lihat Detail →
                        </a>

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-2xl border border-slate-200 bg-white p-12 text-center">

                    <div class="text-5xl">
                        📚
                    </div>

                    <h2 class="mt-4 text-xl font-bold text-slate-900">
                        Buku tidak ditemukan
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Coba gunakan kata kunci atau kategori yang berbeda.
                    </p>

                    <a
                        href="{{ route('books.index') }}"
                        class="mt-5 inline-block rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
                    >
                        Tampilkan Semua Buku
                    </a>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($books->hasPages())

            <div class="mt-10">
                {{ $books->links() }}
            </div>

        @endif

    </div>

</section>

@endsection