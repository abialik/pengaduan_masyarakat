@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 via-red-50 to-pink-50 p-6">
    <div 
        class="w-full max-w-md bg-white/80 backdrop-blur-sm p-8 rounded-xl shadow-lg 
               animate-zoom-in">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Form Registrasi Masyarakat
        </h2>

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-200 text-red-600 px-4 py-2 rounded-lg text-sm animate-fade-in">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('masyarakat.register') }}" method="POST" class="space-y-4">
            @csrf

            <div class="animate-fade-up delay-[100ms]">
                <input type="text" name="nik" placeholder="NIK"
                    class="w-full border-b-2 border-gray-300 focus:border-orange-500 focus:outline-none px-2 py-2 text-sm bg-transparent"
                    value="{{ old('nik') }}" required>
            </div>

            <div class="animate-fade-up delay-[200ms]">
                <input type="text" name="nama" placeholder="Nama"
                    class="w-full border-b-2 border-gray-300 focus:border-orange-500 focus:outline-none px-2 py-2 text-sm bg-transparent"
                    value="{{ old('nama') }}" required>
            </div>

            <div class="animate-fade-up delay-[300ms]">
                <input type="text" name="username" placeholder="Username"
                    class="w-full border-b-2 border-gray-300 focus:border-orange-500 focus:outline-none px-2 py-2 text-sm bg-transparent"
                    value="{{ old('username') }}" required>
            </div>

            <div class="animate-fade-up delay-[400ms]">
                <input type="text" name="telp" placeholder="No. Telepon"
                    class="w-full border-b-2 border-gray-300 focus:border-orange-500 focus:outline-none px-2 py-2 text-sm bg-transparent"
                    value="{{ old('telp') }}" required>
            </div>

            <div class="animate-fade-up delay-[500ms]">
                <input type="password" name="password" placeholder="Password"
                    class="w-full border-b-2 border-gray-300 focus:border-orange-500 focus:outline-none px-2 py-2 text-sm bg-transparent"
                    required>
            </div>

            <div class="animate-fade-up delay-[600ms]">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                    class="w-full border-b-2 border-gray-300 focus:border-orange-500 focus:outline-none px-2 py-2 text-sm bg-transparent"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg transition font-medium animate-fade-up delay-[700ms]">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm mt-6 text-gray-700 animate-fade-up delay-[800ms]">
            Sudah punya akun?
            <a href="{{ route('masyarakat.login') }}" class="text-orange-500 hover:underline font-medium">
                Login di sini
            </a>
        </p>
    </div>
</section>

{{-- Animasi custom --}}
<style>
@keyframes zoomIn {
  0% { opacity: 0; transform: scale(0.9); }
  100% { opacity: 1; transform: scale(1); }
}
.animate-zoom-in {
  animation: zoomIn 0.6s ease-out forwards;
}

@keyframes fadeUp {
  0% { opacity: 0; transform: translateY(15px); }
  100% { opacity: 1; transform: translateY(0); }
}
.animate-fade-up {
  opacity: 0;
  animation: fadeUp 0.6s ease-out forwards;
}
.animate-fade-in {
  opacity: 0;
  animation: fadeUp 0.6s ease-out forwards;
}

/* Delay helper */
.delay-\[100ms\] { animation-delay: 0.1s; }
.delay-\[200ms\] { animation-delay: 0.2s; }
.delay-\[300ms\] { animation-delay: 0.3s; }
.delay-\[400ms\] { animation-delay: 0.4s; }
.delay-\[500ms\] { animation-delay: 0.5s; }
.delay-\[600ms\] { animation-delay: 0.6s; }
.delay-\[700ms\] { animation-delay: 0.7s; }
.delay-\[800ms\] { animation-delay: 0.8s; }
</style>
@endsection
