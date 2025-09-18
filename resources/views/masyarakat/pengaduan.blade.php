@extends('layouts.app')

@section('content')
<section class="min-h-screen flex justify-center items-center bg-white py-12">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-lg" data-aos="zoom-in">
        <h2 class="text-xl font-bold text-center text-orange-600 mb-6">Formulir Pengaduan Masyarakat</h2>

        <form action="{{ route('masyarakat.pengaduan.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="nik" class="block text-sm text-red-500 font-medium mb-1">NIK Anda</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik', Auth::guard('masyarakat')->user()->nik ?? '') }}"
                    class="w-full border border-blue-400 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                    required readonly>
            </div>

            <div>
                <label for="tanggal_pengaduan" class="block text-sm text-red-500 font-medium mb-1">Tanggal Pengaduan</label>
                <input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan"
                    class="w-full border border-blue-400 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                    value="{{ date('Y-m-d') }}" required>
            </div>

            <div>
                <label for="isi_laporan" class="block text-sm text-red-500 font-medium mb-1">Isi Laporan</label>
                <textarea name="isi_laporan" id="isi_laporan" rows="5"
                    class="w-full border border-blue-400 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                    required></textarea>
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
                <div class="border border-dashed border-gray-300 rounded p-4 text-center text-sm text-gray-600">
                    <i class="fa-solid fa-upload text-gray-400 text-2xl mb-2"></i><br>
                    <input type="file" name="foto" id="foto" class="block mx-auto mt-2 text-blue-500 text-sm">
                    <p class="mt-2 text-xs text-gray-500">Attach file. File size of your documents should not exceed 10MB</p>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-semibold transition">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</section>

{{-- AOS Animation --}}
@push('scripts')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                duration: 1000,
                once: true,
                easing: 'ease-in-out'
            });
        });
    </script>
@endpush
@endsection
