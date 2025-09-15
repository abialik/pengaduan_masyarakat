@extends('admin.layouts.app')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r shadow-sm">
        @include('admin.layouts.sidebar')
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8" x-data="{ openModal: false, selectedPengaduan: null }">
        <h2 class="text-3xl font-extrabold mb-6 text-gray-800">📋 Daftar Pengaduan</h2>

        <!-- Card Tabel -->
        <div class="overflow-x-auto bg-white rounded-2xl shadow-lg p-6">
            <table class="min-w-full border-separate border-spacing-y-2">
                <thead>
                    <tr class="bg-gradient-to-r from-orange-200 to-red-200 text-gray-800 font-semibold">
                        <th class="py-3 px-4 text-left rounded-l-lg">Tanggal</th>
                        <th class="py-3 px-4 text-left">NIK</th>
                        <th class="py-3 px-4 text-left">Isi Laporan</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left rounded-r-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $p)
                    <tr class="bg-white shadow-sm hover:shadow-md transition rounded-lg">
                        <td class="py-3 px-4 text-gray-700">{{ $p->tgl_pengaduan }}</td>
                        <td class="py-3 px-4 text-gray-700 font-medium">{{ $p->nik }}</td>
                        <td class="py-3 px-4 text-gray-600">
                            {{ \Illuminate\Support\Str::limit($p->isi_laporan, 50) }}
                        </td>
                        <td class="py-3 px-4">
                            @if($p->status == '0')
                                <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-800 text-sm font-semibold">Belum Ditanggapi</span>
                            @elseif($p->status == 'proses')
                                <span class="px-3 py-1 rounded-full bg-yellow-200 text-yellow-800 text-sm font-semibold">Proses</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-green-200 text-green-800 text-sm font-semibold">Selesai</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <button 
                                @click="selectedPengaduan = {{ $p->toJson() }}; openModal = true" 
                                class="bg-gradient-to-r from-orange-200 to-red-200 text-gray-800 px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 shadow transition"
                            >
                                Detail / Verifikasi
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Detail -->
        <div x-show="openModal" 
             class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center z-50"
             x-cloak>
            <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-2xl relative">
                <button @click="openModal = false" 
                        class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>

                <h3 class="text-2xl font-bold mb-6 text-gray-800">Detail Pengaduan</h3>
                
                <div class="space-y-3 text-gray-700" x-show="selectedPengaduan">
                    <p><strong>NIK:</strong> <span x-text="selectedPengaduan.nik"></span></p>
                    <p><strong>Tanggal:</strong> <span x-text="selectedPengaduan.tgl_pengaduan"></span></p>
                    <p><strong>Isi Laporan:</strong> <span x-text="selectedPengaduan.isi_laporan"></span></p>
                    <p><strong>Status:</strong> 
                        <span class="font-semibold" x-text="selectedPengaduan.status"></span>
                    </p>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button @click="openModal = false" 
                            class="px-5 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
                        Tutup
                    </button>
                    <form :action="`/admin/pengaduan/verifikasi/${selectedPengaduan.id_pengaduan}`" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                class="px-5 py-2 rounded-lg bg-gradient-to-r from-orange-200 to-red-200 text-gray-800 font-semibold hover:opacity-90 shadow transition">
                            Verifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
