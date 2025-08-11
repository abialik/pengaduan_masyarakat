@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-white relative">
    {{-- Background Gradient --}}
    <div class="absolute top-0 left-0 w-1/2 h-64 bg-cyan-100 blur-3xl opacity-60 -z-10 rounded-br-full"></div>
    <div class="absolute top-0 right-0 w-1/3 h-64 bg-orange-100 blur-3xl opacity-50 -z-10 rounded-bl-full"></div>

    <div class="w-full max-w-md bg-orange-100 rounded-lg shadow p-8">
        <h2 class="text-red-600 text-lg font-semibold mb-6">Masuk untuk Melanjutkan</h2>

        {{-- Form Login --}}
        <form action="{{ route('masyarakat.login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nik" class="block text-xs text-blue-600 mb-1">NIK</label>
                <input type="text" name="nik" id="nik"
                    class="w-full border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 text-sm px-1 py-2 bg-transparent"
                    required autofocus>
            </div>

            <div>
                <label for="password" class="block text-xs text-blue-600 mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 text-sm px-1 py-2 bg-transparent"
                    required>
                <div class="text-right mt-1">
                    <a href="#" class="text-xs text-blue-600 hover:underline">Lupa password?</a>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded transition font-medium">
                Masuk
            </button>
        </form>

        <p class="text-center text-xs mt-4 text-blue-600">
            Belum punya akun?
            <a href="{{ route('masyarakat.register') }}" class="text-orange-500 hover:underline">Daftar</a>
        </p>
    </div>
</section>
@endsection
