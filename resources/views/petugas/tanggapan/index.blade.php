@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-pink-50 p-6">
    <div class="max-w-6xl mx-auto bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">
            📋 Pengaduan Masyarakat
        </h1>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-6 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
                <thead class="bg-gradient-to-r from-orange-200 to-orange-100 text-gray-800">
                    <tr>
                        <th class="px-4 py-3 border text-left">ID</th>
                        <th class="px-4 py-3 border text-left">Isi Laporan</th>
                        <th class="px-4 py-3 border text-center">Tanggal</th>
                        <th class="px-4 py-3 border text-center">Status</th>
                        <th class="px-4 py-3 border text-center">Verifikasi</th>
                        <th class="px-4 py-3 border text-center">Tanggapan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $item)
                        <tr class="odd:bg-white even:bg-orange-50 hover:bg-orange-100 transition">
                            <td class="px-4 py-2 border text-center">{{ $item->id_pengaduan }}</td>
                            <td class="px-4 py-2 border">{{ $item->isi_laporan }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->tgl_pengaduan }}</td>
                            <td class="px-4 py-2 border capitalize text-center font-medium">
                                {{ $item->status }}
                            </td>

                            {{-- Tombol verifikasi --}}
                            <td class="px-4 py-2 border text-center">
                                @if($item->status === '0')
                                    <form action="{{ route('petugas.pengaduan.verifikasi', $item->id_pengaduan) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                            Verifikasi
                                        </button>
                                    </form>
                                @elseif($item->status === 'proses')
                                    <span class="text-blue-600 font-semibold">Sedang diproses</span>
                                @else
                                    <span class="text-gray-500">Selesai</span>
                                @endif
                            </td>

                            {{-- Form tanggapan --}}
                            <td class="px-4 py-2 border">
                                <form action="{{ route('petugas.pengaduan.tanggapan', $item->id_pengaduan) }}" method="POST" class="flex space-x-2">
                                    @csrf
                                    <input type="text" name="tanggapan" placeholder="Ketik tanggapan..."
                                        class="flex-1 px-3 py-1 border rounded-lg focus:outline-none focus:ring focus:ring-orange-300 text-sm"
                                        required>
                                    <button type="submit"
                                        class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                        Kirim
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $pengaduan->links() }}
        </div>

        {{-- Tombol kembali ke dashboard --}}
        <div class="mt-8">
            <a href="{{ route('petugas.dashboard') }}"
                class="inline-block px-5 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</section>
@endsection
