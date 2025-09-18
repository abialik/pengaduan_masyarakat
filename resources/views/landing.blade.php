@extends('layouts.app')
@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-orange-100 via-white to-pink-100 min-h-screen flex items-center px-6">
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
            <div class="absolute -z-10 blur-3xl w-72 h-72 bg-orange-300/40 rounded-full top-20 left-10"></div>
        </div>
    </div>
</section>


{{-- Cara Kerja --}}
<section id="carakerja" class="py-24 bg-white text-center">
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8">Bagaimana Cara Kerjanya</h2>
    <p class="text-lg text-gray-600 max-w-4xl mx-auto mb-16 leading-relaxed">
        Kami mempermudah Anda menyampaikan laporan. Cukup daftar, isi formulir, dan pantau prosesnya dengan mudah.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 px-6 sm:px-10">
        @php
            $steps = [
                ['num' => 1, 'title' => 'Register', 'desc' => 'Buat akun untuk akses fitur pelaporan yang aman.'],
                ['num' => 2, 'title' => 'Isi Laporan', 'desc' => 'Laporkan masalah Anda dengan data yang lengkap.'],
                ['num' => 3, 'title' => 'Verifikasi', 'desc' => 'Petugas memverifikasi dan menanggapi laporan Anda.'],
                ['num' => 4, 'title' => 'Pantau', 'desc' => 'Lihat perkembangan laporan Anda secara real-time.'],
            ];
        @endphp

        @foreach ($steps as $step)
            <div class="relative flex flex-col items-center bg-white p-10 rounded-3xl border border-gray-100/50 shadow-md hover:shadow-xl hover:-translate-y-3 transition duration-500">
                <div class="absolute -top-8 bg-gradient-to-r from-orange-600 to-pink-500 text-white w-14 h-14 flex items-center justify-center rounded-full font-bold text-xl shadow-lg">
                    {{ $step['num'] }}
                </div>
                <h3 class="mt-8 text-xl font-semibold text-gray-900">{{ $step['title'] }}</h3>
                <p class="text-base text-gray-600 mt-4 max-w-xs">{{ $step['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- FAQ --}}
<section id="faq" class="bg-gray-50 py-24 px-6">
    <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-16">Pertanyaan yang Sering Ditanyakan</h2>

    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-start">
        <div class="flex justify-center">
            <img src="{{ asset('img/faq.png') }}" alt="Ilustrasi FAQ" 
                 class="w-4/5 max-w-md rounded-2xl shadow-xl">
        </div>

        <div x-data="{ selected: null }" class="space-y-6">
            @php
                $faqs = [
                    ['question' => 'Apakah identitas pelapor dirahasiakan?', 'answer' => 'Ya, identitas pelapor akan dirahasiakan untuk menjaga keamanan dan kenyamanan.'],
                    ['question' => 'Siapa yang menangani laporan?', 'answer' => 'Laporan Anda akan diteruskan ke petugas berwenang yang sesuai dengan jenis pengaduan.'],
                    ['question' => 'Berapa lama waktu tanggapan?', 'answer' => 'Biasanya 1–3 hari kerja tergantung tingkat urgensi dan kompleksitas laporan.'],
                    ['question' => 'Apakah saya bisa memantau status laporan?', 'answer' => 'Ya, Anda bisa memantau status laporan melalui dashboard akun Anda.'],
                ];
            @endphp

            @foreach ($faqs as $index => $faq)
                <div class="border border-gray-200 rounded-2xl bg-white shadow-md overflow-hidden transition hover:shadow-lg">
                    <button @click="selected === {{ $index }} ? selected = null : selected = {{ $index }}"
                        class="w-full flex justify-between items-center px-6 py-5 text-left text-gray-900 font-semibold hover:bg-gray-50 transition duration-300">
                        <span>{{ $faq['question'] }}</span>
                        <svg x-show="selected !== {{ $index }}" class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6v12m6-6H6"/></svg>
                        <svg x-show="selected === {{ $index }}" class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 12H6"/></svg>
                    </button>
                    <div x-show="selected === {{ $index }}" x-transition.opacity.scale class="px-6 pb-6 text-gray-600 leading-relaxed">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Testimoni --}}
<section class="bg-white py-24 px-6">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-12">Apa Kata Mereka</h2>
        <p class="text-lg text-gray-600 mb-16 max-w-3xl mx-auto">
            Suara masyarakat yang sudah menggunakan layanan pengaduan ini.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-gradient-to-br from-orange-50 to-white p-8 rounded-3xl shadow-md hover:shadow-lg transition">
                <p class="text-gray-700 leading-relaxed mb-6">
                    “Proses pelaporan sangat mudah dan transparan. Saya bisa memantau status laporan kapan saja.”
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=12" class="w-14 h-14 rounded-full shadow-md">
                    <div class="text-left">
                        <h4 class="font-semibold text-gray-900">Rahma Putri</h4>
                        <p class="text-sm text-gray-500">Warga Bandung</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-pink-50 to-white p-8 rounded-3xl shadow-md hover:shadow-lg transition">
                <p class="text-gray-700 leading-relaxed mb-6">
                    “Saya merasa aman melaporkan masalah di lingkungan saya karena identitas dirahasiakan.”
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=25" class="w-14 h-14 rounded-full shadow-md">
                    <div class="text-left">
                        <h4 class="font-semibold text-gray-900">Budi Santoso</h4>
                        <p class="text-sm text-gray-500">Warga Surabaya</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-3xl shadow-md hover:shadow-lg transition">
                <p class="text-gray-700 leading-relaxed mb-6">
                    “Laporan saya cepat ditindaklanjuti. Terima kasih atas pelayanan yang responsif!”
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=33" class="w-14 h-14 rounded-full shadow-md">
                    <div class="text-left">
                        <h4 class="font-semibold text-gray-900">Siti Aisyah</h4>
                        <p class="text-sm text-gray-500">Warga Jakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Tentang Kami --}}
<section id="tentang" class="py-24 bg-gray-50 px-6">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
        {{-- Gambar --}}
        <div data-aos="fade-right" class="flex justify-center">
            <img src="{{ asset('img/about.png') }}" alt="Tentang Kami"
                 class="w-4/5 max-w-md rounded-3xl shadow-xl">
        </div>

        {{-- Teks --}}
        <div data-aos="fade-left">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-6">Tentang Pengaduan Masyarakat</h2>
            <p class="text-lg text-gray-600 leading-relaxed mb-6">
                Platform ini dibuat untuk memudahkan masyarakat dalam menyampaikan keluhan atau laporan
                terkait layanan publik. Kami percaya bahwa suara Anda adalah kunci untuk menciptakan
                perubahan yang lebih baik dan transparan.
            </p>
            <ul class="space-y-4 text-gray-700">
                <li class="flex items-start gap-3">
                    <span class="text-blue-600 text-xl">✔</span>
                    <span>Proses pelaporan cepat, aman, dan mudah diakses.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-blue-600 text-xl">✔</span>
                    <span>Identitas pelapor dijamin kerahasiaannya.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-blue-600 text-xl">✔</span>
                    <span>Laporan langsung diteruskan ke instansi terkait.</span>
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- Laporan Saya --}}
@auth('masyarakat')
    @if(isset($pengaduans))
    <section class="bg-gradient-to-br from-orange-50 via-white to-orange-50 py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-14 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
                </svg>
                <span>Laporan Saya</span>
            </h2>

            @if($pengaduans->isEmpty())
                <div class="bg-white p-12 rounded-3xl shadow-md text-center">
                    <p class="text-gray-500 text-lg">Belum ada laporan yang dikirim.</p>
                </div>
            @else
                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pengaduans as $item)
                        <div class="group relative flex flex-col rounded-3xl overflow-hidden bg-white shadow-md hover:shadow-lg transition duration-300 border border-gray-200">
                            {{-- Foto --}}
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" 
                                     alt="Foto Laporan" 
                                     class="w-full h-52 object-cover group-hover:scale-105 transition duration-300 rounded-t-3xl">
                            @else
                                <div class="w-full h-52 bg-gray-100 flex items-center justify-center text-gray-400 text-sm rounded-t-3xl">
                                    Tidak ada foto
                                </div>
                            @endif

                            {{-- Konten --}}
                            <div class="p-6 flex flex-col flex-1">
                                <p class="text-sm text-gray-500 mb-2 font-mono">
                                    📅 {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}
                                </p>
                                <p class="text-gray-900 font-semibold mb-6 line-clamp-3 leading-relaxed">
                                    {{ $item->isi_laporan }}
                                </p>

                                {{-- Status --}}
                                <span class="mt-auto inline-block text-sm font-semibold px-4 py-2 rounded-full self-start
                                    {{ $item->status === '0' ? 'bg-red-100 text-red-700' : ($item->status === 'proses' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
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
        </div>
    </section>
    @endif
@endauth
@endsection

{{-- Smooth Scroll Script --}}
@push('scripts')
<script>
    function smoothScrollTo(target, duration = 1200) {
        const start = window.pageYOffset;
        const end = typeof target === "number" ? target : target.getBoundingClientRect().top + window.pageYOffset;
        const distance = end - start;
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);

            // EaseInOutQuart
            const ease = progress < 0.5 
                ? 8 * progress * progress * progress * progress 
                : 1 - Math.pow(-2 * progress + 2, 4) / 2;

            window.scrollTo(0, start + distance * ease);

            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        requestAnimationFrame(animation);
    }

    // Aktifkan smooth scroll ke semua link dengan href="#..."
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                smoothScrollTo(target, 1200);
            }
        });
    });
</script>
@endpush
