@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 via-white to-cyan-50 relative">
    {{-- Background Effect --}}
    <div class="absolute top-0 left-0 w-1/2 h-72 bg-cyan-200 blur-3xl opacity-50 -z-10 rounded-br-full"></div>
    <div class="absolute bottom-0 right-0 w-1/3 h-72 bg-orange-200 blur-3xl opacity-50 -z-10 rounded-tl-full"></div>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 animate-zoom-in">
        <!-- Heading -->
        <div class="text-center mb-8 animate-fade-up delay-[100ms]">
            <div class="w-14 h-14 flex items-center justify-center mx-auto bg-orange-500 text-white rounded-full shadow">
                <i class="fas fa-user text-2xl"></i>
            </div>
            <h2 class="mt-4 text-2xl font-bold text-gray-800">Masuk</h2>
            <p class="text-sm text-gray-500">Gunakan akun anda untuk melanjutkan</p>
        </div>

        {{-- Form Login --}}
        <form action="{{ route('masyarakat.login') }}" method="POST" class="space-y-5">
            @csrf

            <!-- NIK -->
            <div class="animate-fade-up delay-[200ms]">
                <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-id-card"></i>
                    </span>
                    <input type="text" name="nik" id="nik"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none"
                        placeholder="Masukkan NIK" required autofocus>
                </div>
            </div>

            <!-- Password -->
            <div class="animate-fade-up delay-[300ms]">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" id="password"
                        class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none"
                        placeholder="Masukkan password" required>
                    <!-- Toggle password -->
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-400 hover:text-gray-600" 
                          onclick="let p=document.getElementById('password'); p.type=p.type==='password'?'text':'password'">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full relative bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 rounded-lg shadow-lg 
                    transition duration-300 
                    before:content-[''] before:absolute before:inset-0 before:rounded-lg 
                    before:blur-xl before:opacity-50 before:bg-orange-400 before:-z-10 hover:before:opacity-80 animate-fade-up delay-[400ms]">
                Masuk
            </button>

            <p class="text-center text-sm mt-6 text-gray-600 animate-fade-up delay-[500ms]">
                Belum punya akun?
                <a href="{{ route('masyarakat.register') }}" class="text-orange-500 font-semibold hover:underline">Daftar</a>
            </p>
        </form>
    </div>
</section>

{{-- Tambahan animasi --}}
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

/* Delay helper */
.delay-\[100ms\] { animation-delay: 0.1s; }
.delay-\[200ms\] { animation-delay: 0.2s; }
.delay-\[300ms\] { animation-delay: 0.3s; }
.delay-\[400ms\] { animation-delay: 0.4s; }
.delay-\[500ms\] { animation-delay: 0.5s; }
</style>
@endsection
