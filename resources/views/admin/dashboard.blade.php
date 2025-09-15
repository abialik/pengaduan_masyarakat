@extends('admin.layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50"
     x-data="{
        openModal: false,
        selectedPengaduan: null,
        showDetail(p) {
            this.selectedPengaduan = p;
            this.openModal = true;
        }
     }">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r shadow-md">
        @include('admin.layouts.sidebar')
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-8 text-orange-600">📊 Dashboard Admin</h1>
            
                            {{-- Statistik --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                    <div class="bg-orange-600 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center transform hover:scale-105 transition">
                        <i class="fas fa-file-alt text-4xl mb-3"></i>
                        <div class="font-medium">Total Pengaduan</div>
                        <div class="text-3xl font-extrabold">{{ $total_pengaduan ?? 0 }}</div>
                    </div>
                    <div class="bg-yellow-500 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center transform hover:scale-105 transition">
                        <i class="fas fa-spinner text-4xl mb-3"></i>
                        <div class="font-medium">Proses</div>
                        <div class="text-3xl font-extrabold">{{ $pengaduan_proses ?? 0 }}</div>
                    </div>
                    <div class="bg-green-600 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center transform hover:scale-105 transition">
                        <i class="fas fa-check-circle text-4xl mb-3"></i>
                        <div class="font-medium">Selesai</div>
                        <div class="text-3xl font-extrabold">{{ $pengaduan_selesai ?? 0 }}</div>
                    </div>
                    <div class="bg-blue-600 text-white rounded-2xl p-6 shadow-xl flex flex-col items-center transform hover:scale-105 transition">
                        <i class="fas fa-user-shield text-4xl mb-3"></i>
                        <div class="font-medium">Jumlah Petugas</div>
                        <div class="text-3xl font-extrabold">{{ $total_petugas ?? 0 }}</div>
                    </div>
                </div>

            
            <h2 class="text-2xl font-bold mb-6 text-orange-600">📑 Daftar Pengaduan</h2>

            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wide">
                            <th class="py-3 px-4 text-left">Tanggal</th>
                            <th class="py-3 px-4 text-left">NIK</th>
                            <th class="py-3 px-4 text-left">Isi Laporan</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduan as $p)
                        <tr class="border-b border-gray-200 even:bg-gray-50 hover:bg-orange-50 transition">
                            <td class="py-2 px-4">{{ $p->tgl_pengaduan }}</td>
                            <td class="py-2 px-4">{{ $p->nik }}</td>
                            <td class="py-2 px-4">{{ \Illuminate\Support\Str::limit($p->isi_laporan, 50) }}</td>
                            <td class="py-2 px-4">
                                @if($p->status == '0')
                                    <span class="px-3 py-1 rounded-full bg-gray-300 text-white text-xs">Belum Ditanggapi</span>
                                @elseif($p->status == 'proses')
                                    <span class="px-3 py-1 rounded-full bg-yellow-500 text-white text-xs">Proses</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs">Selesai</span>
                                @endif
                            </td>
                            <td class="py-2 px-4">
                                <button 
                                    @click="showDetail({
                                        id_pengaduan: '{{ $p->id_pengaduan }}',
                                        tgl_pengaduan: '{{ $p->tgl_pengaduan }}',
                                        nik: '{{ $p->nik }}',
                                        isi_laporan: `{{ addslashes($p->isi_laporan) }}` ,
                                        status: '{{ $p->status }}',
                                        foto: '{{ $p->foto }}'
                                    })"
                                    class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs hover:bg-orange-600 transition"
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
            <div 
                x-show="openModal" 
                x-transition.opacity.scale
                x-cloak
                class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/50 z-50"
            >
                <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6 relative animate-fadeIn">
                    <button 
                        @click="openModal = false" 
                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-600"
                    >
                        ✕
                    </button>
                    
                    <h3 class="text-lg font-bold mb-4 text-orange-600">Detail Pengaduan</h3>

                    <table class="w-full text-sm">
                        <tr><th class="text-left py-2 pr-4 w-1/3">Tanggal</th>
                            <td x-text="selectedPengaduan.tgl_pengaduan"></td></tr>
                        <tr><th class="text-left py-2 pr-4">NIK</th>
                            <td x-text="selectedPengaduan.nik"></td></tr>
                        <tr><th class="text-left py-2 pr-4">Isi Laporan</th>
                            <td x-text="selectedPengaduan.isi_laporan"></td></tr>
                        <tr><th class="text-left py-2 pr-4">Status</th>
                            <td>
                                <template x-if="selectedPengaduan.status == '0'">
                                    <span class="px-2 py-1 rounded bg-gray-400 text-white text-xs">Belum Ditanggapi</span>
                                </template>
                                <template x-if="selectedPengaduan.status == 'proses'">
                                    <span class="px-2 py-1 rounded bg-yellow-500 text-white text-xs">Proses</span>
                                </template>
                                <template x-if="selectedPengaduan.status == 'selesai'">
                                    <span class="px-2 py-1 rounded bg-green-500 text-white text-xs">Selesai</span>
                                </template>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left py-2 pr-4">Foto</th>
                            <td>
                                <template x-if="selectedPengaduan.foto">
                                    <img :src="'/storage/' + selectedPengaduan.foto" class="w-48 rounded-lg border">
                                </template>
                                <template x-if="!selectedPengaduan.foto">
                                    <span class="text-gray-500">Tidak ada foto</span>
                                </template>
                            </td>
                        </tr>
                    </table>

                    <!-- Form Tanggapan -->
                    <form action="{{ route('tanggapan.store') }}" method="POST" class="mt-6 border-t pt-4">
                        @csrf
                        <input type="hidden" name="id_pengaduan" :value="selectedPengaduan.id_pengaduan" />
                        <div class="mb-3">
                            <label class="block font-medium mb-1">Tanggapan</label>
                            <textarea name="tanggapan" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-400" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="block font-medium mb-1">Status</label>
                            <select name="status" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-orange-400" required>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                                Kirim
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 text-right">
                        <button 
                            @click="openModal = false" 
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
