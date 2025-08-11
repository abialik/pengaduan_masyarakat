@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<section class="text-center py-24 px-4 relative overflow-hidden bg-gradient-to-b from-orange-50 to-white">
    <div class="absolute top-0 left-0 w-64 h-64 bg-orange-400 rounded-full blur-3xl opacity-30 -z-10"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-orange-400 rounded-full blur-3xl opacity-30 -z-10"></div>

    <h1 class="text-4xl sm:text-5xl font-bold max-w-3xl mx-auto leading-tight text-gray-800">
        Suara Anda, Perubahan Kami – Laporkan Sekarang untuk Pelayanan Publik Lebih Baik!
    </h1>

    @auth('masyarakat')
        <a href="{{ route('masyarakat.pengaduan') }}"
            class="mt-8 inline-block bg-orange-500 text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
            Buat Laporan
        </a>
    @else
        <a href="{{ route('masyarakat.login') }}"
            class="mt-8 inline-block bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition">
            Mulai Laporkan Sekarang
        </a>
    @endauth
</section>

{{-- Cara Kerja --}}
<section id="carakerja" class="py-20 bg-white text-center">
    <h2 class="text-3xl font-bold text-blue-600 mb-4">Bagaimana Cara Kerjanya</h2>
    <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-12">
        Kami mempermudah Anda menyampaikan laporan. Cukup daftar dan isi formulir. Tim kami akan segera memprosesnya secara transparan dan bertanggung jawab.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-8">
        @php
            $steps = [
                ['img' => 'step1.png', 'title' => 'Register', 'desc' => 'Buat akun untuk akses fitur pelaporan yang aman.'],
                ['img' => 'step2.png', 'title' => 'Isi Laporan', 'desc' => 'Laporkan masalah Anda dengan data yang lengkap.'],
                ['img' => 'step3.png', 'title' => 'Verifikasi', 'desc' => 'Petugas memverifikasi dan menanggapi laporan Anda.'],
                ['img' => 'step4.png', 'title' => 'Pantau', 'desc' => 'Lihat perkembangan laporan Anda secara real-time.'],
            ];
        @endphp

        @foreach ($steps as $step)
            <div class="flex flex-col items-center text-center p-6 bg-white rounded-xl shadow-md">
                <img src="{{ asset('img/' . $step['img']) }}" alt="{{ $step['title'] }}" class="mb-4 h-20 w-20">
                <h3 class="text-lg font-semibold text-gray-900">{{ $step['title'] }}</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $step['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- FAQ --}}
<section id="faq" class="bg-gray-50 py-16 px-6">
    <h2 class="text-3xl font-bold text-blue-600 text-center mb-10">Pertanyaan yang Sering Ditanyakan</h2>

    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div class="flex justify-center">
            <img src="{{ asset('img/faq.png') }}" alt="Ilustrasi FAQ" class="w-3/4 max-w-sm">
        </div>

        <div x-data="{ selected: null }" class="space-y-4">
            @php
                $faqs = [
                    ['question' => 'Apakah identitas pelapor dirahasiakan?', 'answer' => 'Ya, identitas pelapor akan dirahasiakan untuk menjaga keamanan dan kenyamanan.'],
                    ['question' => 'Siapa yang menangani laporan?', 'answer' => 'Laporan Anda akan diteruskan ke petugas berwenang yang sesuai dengan jenis pengaduan.'],
                    ['question' => 'Berapa lama waktu tanggapan?', 'answer' => 'Biasanya 1–3 hari kerja tergantung tingkat urgensi dan kompleksitas laporan.'],
                    ['question' => 'Apakah saya bisa memantau status laporan?', 'answer' => 'Ya, Anda bisa memantau status laporan melalui dashboard akun Anda.'],
                ];
            @endphp

            @foreach ($faqs as $index => $faq)
                <div class="border rounded-lg">
                    <button @click="selected === {{ $index }} ? selected = null : selected = {{ $index }}"
                        class="w-full flex justify-between items-center px-4 py-3 text-left text-gray-800 hover:bg-gray-50">
                        <span>{{ $faq['question'] }}</span>
                        <span class="text-blue-600 text-xl" x-text="selected === {{ $index }} ? '-' : '+'"></span>
                    </button>

                    <div x-show="selected === {{ $index }}" x-transition x-cloak class="px-4 pb-4 text-gray-600 text-sm">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Laporan Saya --}}
@auth('masyarakat')
    @if(isset($pengaduans))
    <section class="bg-white py-16 px-6">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Laporan Saya</h2>

            @if($pengaduans->isEmpty())
                <p class="text-gray-500">Belum ada laporan yang dikirim.</p>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pengaduans as $item)
                        <div class="p-4 border rounded-lg shadow bg-white">
                            <p class="text-sm text-gray-500 mb-2">Tanggal: {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}</p>
                            <p class="text-gray-800 mb-3">{{ $item->isi_laporan }}</p>

                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Laporan" class="w-full h-40 object-cover rounded mb-3">
                            @endif

                            <span class="text-sm font-medium {{ $item->status === '0' ? 'text-red-500' : 'text-green-600' }}">
                                Status:
                                @if($item->status === '0')
                                    Belum diproses
                                @elseif($item->status === 'proses')
                                    Sedang diproses
                                @else
                                    Selesai
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    @endif
@endauth
@endsection
