@extends('layouts.app')

@section('title', 'Login - Sekolah Literasi')

@section('content')

<section class="flex min-h-[calc(100vh-80px)] items-center justify-center bg-slate-50 px-6 py-12">

    <div class="w-full max-w-md">

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">

            <div class="text-center">

                <div class="text-5xl">
                    📚
                </div>

                <h1 class="mt-4 text-2xl font-bold text-slate-900">
                    Selamat Datang
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Login ke akun Sekolah Literasi kamu.
                </p>

            </div>


            @if($errors->any())

                <div class="mt-6 rounded-lg bg-red-50 p-4 text-sm text-red-700">

                    <ul class="list-disc space-y-1 pl-5">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('login.store') }}"
                method="POST"
                class="mt-8 space-y-5"
            >

                @csrf

                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="nama@email.com"
                    >

                </div>


                <div>

                    <label
                        for="password"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        placeholder="••••••••"
                    >

                </div>


                <div class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        value="1"
                        class="rounded border-slate-300"
                    >

                    <label
                        for="remember"
                        class="text-sm text-slate-600"
                    >
                        Ingat saya
                    </label>

                </div>


                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white transition hover:bg-blue-700"
                >
                    Login
                </button>

            </form>


            <p class="mt-6 text-center text-sm text-slate-500">

                Belum punya akun?

                <a
                    href="{{ route('register') }}"
                    class="font-semibold text-blue-600 hover:text-blue-700"
                >
                    Daftar sekarang
                </a>

            </p>

        </div>

    </div>

</section>

@endsection