@extends('admin.layouts.app')

@section('content')
<div class="p-8 bg-white rounded-2xl shadow-lg">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-extrabold text-gray-800">📊 Laporan Pengaduan</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.laporan.pdf') }}" 
               class="px-5 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-gray-900 rounded-xl shadow hover:opacity-90 transition flex items-center gap-2 font-semibold">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('admin.laporan.excel') }}" 
               class="px-5 py-2 bg-gradient-to-r from-green-400 to-emerald-600 text-gray-900 rounded-xl shadow hover:opacity-90 transition flex items-center gap-2 font-semibold">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('admin.dashboard') }}" 
               class="px-5 py-2 bg-gray-200 text-gray-800 rounded-xl shadow hover:bg-gray-300 transition flex items-center gap-2 font-semibold">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-blue-100 to-indigo-100 text-gray-800">
                    <th class="p-3 font-semibold">No</th>
                    <th class="p-3 font-semibold">Tanggal</th>
                    <th class="p-3 font-semibold">NIK</th>
                    <th class="p-3 font-semibold">Nama</th>
                    <th class="p-3 font-semibold">Laporan</th>
                    <th class="p-3 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduan as $i => $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-3 border-t text-gray-700">{{ $i+1 }}</td>
                    <td class="p-3 border-t text-gray-700">{{ $p->tgl_pengaduan }}</td>
                    <td class="p-3 border-t text-gray-700">{{ $p->nik }}</td>
                    <td class="p-3 border-t text-gray-700">{{ $p->masyarakat->nama }}</td>
                    <td class="p-3 border-t text-gray-600">{{ Str::limit($p->isi_laporan, 80) }}</td>
                    <td class="p-3 border-t">
                        @if($p->status == '0')
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-200 text-gray-800">Belum Ditanggapi</span>
                        @elseif($p->status == 'proses')
                            <span class="px-3 py-1 text-sm rounded-full bg-yellow-200 text-yellow-800">Proses</span>
                        @else
                            <span class="px-3 py-1 text-sm rounded-full bg-green-200 text-green-800">Selesai</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
