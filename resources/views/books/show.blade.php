@extends('layouts.app')

@section('title', $book->title . ' - Sekolah Literasi')

@section('content')

<section class="bg-slate-50 py-14">

    <div class="mx-auto max-w-6xl px-6">

        {{-- Back --}}
        <a
            href="{{ route('books.index') }}"
            class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700"
        >
            ← Kembali ke Buku
        </a>


        <div class="mt-8 grid gap-10 lg:grid-cols-3">

            {{-- Cover --}}
            <div>

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    @if($book->cover)

                        <img
                            src="{{ asset('storage/' . $book->cover) }}"
                            alt="{{ $book->title }}"
                            class="w-full object-cover"
                        >

                    @else

                        <div class="flex aspect-[3/4] items-center justify-center bg-slate-100">
                            <span class="text-7xl">
                                📖
                            </span>
                        </div>

                    @endif

                </div>

            </div>


            {{-- Information --}}
            <div class="lg:col-span-2">

                @if($book->category)

                    <span class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                        {{ $book->category->name }}
                    </span>

                @endif


                <h1 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                    {{ $book->title }}
                </h1>


                <p class="mt-3 text-lg text-slate-500">
                    {{ $book->author ?? 'Penulis tidak tersedia' }}
                </p>


                {{-- Metadata --}}
                <div class="mt-8 grid gap-4 sm:grid-cols-2">

                    <div class="rounded-xl border border-slate-200 bg-white p-4">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Penerbit
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $book->publisher ?? '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl border border-slate-200 bg-white p-4">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Tahun Terbit
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $book->year ?? '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl border border-slate-200 bg-white p-4">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Stok
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $book->stock }}
                        </p>

                    </div>


                    <div class="rounded-xl border border-slate-200 bg-white p-4">

                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            Status
                        </p>

                        @if($book->is_available)

                            <p class="mt-1 font-semibold text-green-600">
                                ✓ Tersedia
                            </p>

                        @else

                            <p class="mt-1 font-semibold text-red-600">
                                Tidak tersedia
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Synopsis --}}
                <div class="mt-10">

                    <h2 class="text-2xl font-bold text-slate-900">
                        Sinopsis
                    </h2>

                    <div class="mt-4 leading-8 text-slate-600">

                        @if($book->synopsis)

                            {!! nl2br(e($book->synopsis)) !!}

                        @else

                            <p>
                                Sinopsis buku belum tersedia.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Read Button --}}
                @if($book->is_available)

                    <div class="mt-8">

                        <button
                            type="button"
                            class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700"
                        >
                            📖 Mulai Membaca
                        </button>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection