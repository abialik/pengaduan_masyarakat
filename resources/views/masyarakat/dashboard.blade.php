@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-orange-100 via-white to-pink-100 min-h-screen flex items-center px-6 overflow-hidden">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
        {{-- Text --}}
        <div class="text-center md:text-left" data-aos="fade-right">
            <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight text-gray-900 tracking-tight">
                Suara Anda, <span class="bg-gradient-to-r from-orange-600 to-pink-500 bg-clip-text text-transparent">Perubahan Kami</span>
                <br class="hidden sm:block"> 
                Laporkan Sekarang untuk Layanan Publik Lebih Baik!
            </h1>
            <p class="mt-8 text-gray-600 text-xl max-w-xl mx-auto md:mx-0 leading-relaxed">
                Platform pelaporan masyarakat yang cepat, aman, dan transparan.
            </p>

            @auth('masyarakat')
                <a href="{{ route('masyarakat.pengaduan') }}"
                   class="scroll-link mt-10 inline-flex items-center gap-3 bg-gradient-to-r from-orange-600 to-pink-500 text-white px-10 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition transform duration-300 font-semibold">
                    ✍️ Buat Laporan
                </a>
            @else
                <a href="#carakerja"
                   class="scroll-link mt-10 inline-flex items-center gap-3 bg-gray-900 text-white px-10 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition transform duration-300 font-semibold">
                    🚀 Mulai Laporkan Sekarang
                </a>
            @endauth
        </div>

        {{-- Illustration --}}
        <div class="flex justify-center md:justify-end relative" data-aos="zoom-in-up">
            <img src="{{ asset('img/hero.png') }}" alt="Ilustrasi Hero" 
                 class="w-full max-w-2xl rounded-3xl shadow-2xl drop-shadow-xl hover:scale-105 transition duration-500">
            {{-- Parallax Blur --}}
            <div id="parallax-circle" class="absolute -z-10 blur-3xl w-72 h-72 bg-orange-300/40 rounded-full top-20 left-10"></div>
        </div>
    </div>
</section>

{{-- Daftar Laporan --}}
<div class="bg-gradient-to-br from-orange-50 via-white to-pink-50 py-20 px-6">
    <div class="max-w-7xl mx-auto">

        @if(isset($pengaduans))
            <h2 class="text-3xl font-extrabold text-gray-900 mb-12 text-center md:text-left border-b-2 border-orange-200 pb-4" data-aos="fade-up">
                📋 Laporan Saya
            </h2>

            @if($pengaduans->isEmpty())
                <div class="bg-white p-16 rounded-3xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-gray-500 text-lg">Belum ada laporan yang dikirim 🚫</p>
                </div>
            @else
                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pengaduans as $item)
                        <div class="group relative flex flex-col rounded-3xl overflow-hidden bg-white shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300 border border-gray-100" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            {{-- Foto --}}
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" 
                                     alt="Foto Laporan" 
                                     class="w-full h-56 object-cover group-hover:scale-105 transition duration-500 rounded-t-3xl">
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-400 text-sm rounded-t-3xl">
                                    📷 Tidak ada foto
                                </div>
                            @endif

                            {{-- Konten --}}
                            <div class="p-6 flex flex-col flex-1">
                                <p class="text-sm text-gray-500 mb-3 font-medium flex items-center gap-1">
                                    <span class="text-lg">📅</span> 
                                    {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}
                                </p>

                                <p class="text-gray-900 font-semibold mb-6 line-clamp-3 leading-relaxed text-justify">
                                    {{ $item->isi_laporan }}
                                </p>

                                {{-- Status --}}
                                <span class="mt-auto inline-block text-sm font-semibold px-5 py-2 rounded-full self-start shadow-sm
                                    {{ $item->status === '0' ? 'bg-red-100 text-red-700 border border-red-200' : ($item->status === 'proses' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : 'bg-green-100 text-green-800 border border-green-200') }}">
                                    @if($item->status === '0')
                                        ⏳ Belum diproses
                                    @elseif($item->status === 'proses')
                                        🔄 Sedang diproses
                                    @else
                                        ✅ Selesai
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>

{{-- Script untuk smooth scroll, animasi & parallax --}}
@push('scripts')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi AOS (animasi scroll, bisa muncul lagi saat scroll ke atas)
            AOS.init({
                duration: 1000,
                once: false, // biar animasi jalan lagi saat scroll ke atas
                easing: 'ease-in-out'
            });

            // Smooth scroll ke anchor
            document.querySelectorAll('.scroll-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href').startsWith("#")) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            // Parallax Effect pada lingkaran blur
            const parallaxCircle = document.getElementById("parallax-circle");
            window.addEventListener("scroll", () => {
                let offset = window.scrollY * 0.3; // semakin kecil semakin halus
                parallaxCircle.style.transform = `translateY(${offset}px)`;
            });
        });
    </script>
@endpush

@endsection
