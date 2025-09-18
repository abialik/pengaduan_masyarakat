@extends('petugas.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 max-w-7xl mx-auto bg-gray-50 min-h-screen">
    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 tracking-tight">Dashboard Petugas</h1>
        <p class="mt-2 text-gray-600 text-sm sm:text-base">Kelola laporan masyarakat dengan cepat, transparan, dan profesional.</p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        {{-- Total Laporan --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:scale-105 hover:-translate-y-1 duration-300 p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-orange-100 text-orange-600 text-xl">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Laporan</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $pengaduan->total() }}</h3>
                </div>
            </div>
        </div>

        {{-- Terverifikasi --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:scale-105 hover:-translate-y-1 duration-300 p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-green-100 text-green-600 text-xl">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Terverifikasi</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Pengaduan::where('status', 'selesai')->count() }}</h3>
                </div>
            </div>
        </div>

        {{-- Proses --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:scale-105 hover:-translate-y-1 duration-300 p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-yellow-100 text-yellow-600 text-xl">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Proses</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Pengaduan::where('status', 'proses')->count() }}</h3>
                </div>
            </div>
        </div>

        {{-- Belum Diproses --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:scale-105 hover:-translate-y-1 duration-300 p-6">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-xl bg-red-100 text-red-600 text-xl">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Belum Diproses</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ \App\Models\Pengaduan::where('status', '0')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Daftar Pengaduan --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        {{-- Header --}}
        <div class="flex justify-between items-center px-6 py-4 border-b bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-list-alt text-gray-500"></i>
                Daftar Pengaduan Masyarakat
            </h2>
            <span class="text-xs bg-gray-200 px-3 py-1 rounded-full text-gray-700">
                Total: {{ $pengaduan->total() }}
            </span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Isi Laporan</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengaduan as $item)
                        <tr class="hover:bg-gray-50 transition transform hover:scale-102 duration-200">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $item->id_pengaduan }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ Str::limit($item->isi_laporan, 60) }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $item->status === '0' ? 'bg-red-100 text-red-600' : 
                                       ($item->status === 'proses' ? 'bg-yellow-100 text-yellow-700' : 
                                       'bg-green-100 text-green-700') }}">
                                    {{ $item->status === '0' ? 'Belum Diproses' : ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex justify-center gap-2">
                                {{-- Tombol Verifikasi --}}
                                <form action="{{ route('petugas.pengaduan.verifikasi', $item->id_pengaduan) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="px-4 py-2 bg-green-500 text-white text-xs rounded-lg hover:bg-green-600 transition transform hover:scale-105 duration-200 shadow font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i> Verifikasi
                                    </button>
                                </form>

                                {{-- Link Tanggapan --}}
                                <a href="{{ route('petugas.pengaduan.show', $item->id_pengaduan) }}"
                                   class="px-4 py-2 bg-orange-500 text-white text-xs rounded-lg hover:bg-orange-600 transition transform hover:scale-105 duration-200 shadow font-semibold">
                                    <i class="fas fa-reply mr-1"></i> Tanggapan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">
                                Belum ada pengaduan dari masyarakat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 bg-gray-50 border-t">
            {{ $pengaduan->links() }}
        </div>
    </div>
</div>
@endsection
