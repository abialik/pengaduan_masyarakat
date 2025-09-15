@extends('petugas.layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Detail Pengaduan</h2>

    <div class="mb-4 p-4 border rounded">
        <p><strong>Tanggal:</strong> {{ $pengaduan->tgl_pengaduan }}</p>
        <p><strong>NIK:</strong> {{ $pengaduan->nik }}</p>
        <p><strong>Isi Laporan:</strong> {{ $pengaduan->isi_laporan }}</p>
        <p><strong>Status:</strong> {{ $pengaduan->status }}</p>
    </div>

    @if($pengaduan->tanggapan)
        <div class="mb-4 p-4 bg-green-100 rounded">
            <h3 class="font-semibold">Tanggapan:</h3>
            <p>{{ $pengaduan->tanggapan->tanggapan }}</p>
        </div>
    @else
        <form action="{{ route('petugas.pengaduan.tanggapan', $pengaduan->id_pengaduan) }}" method="POST" class="flex space-x-2">
            @csrf
            <input type="text" name="tanggapan" placeholder="Ketik tanggapan..."
                class="flex-1 px-3 py-1 border rounded focus:outline-none focus:ring focus:ring-blue-300" required>
            <button type="submit"
                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                Kirim
            </button>
        </form>
    @endif
</div>
@endsection
