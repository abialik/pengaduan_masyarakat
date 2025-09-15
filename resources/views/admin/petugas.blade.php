@extends('admin.layouts.app')

@section('content')
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50" x-data="{ openModal: false }">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r shadow-md">
        @include('admin.layouts.sidebar')
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">👥 Manajemen Petugas</h2>
            <button @click="openModal = true" 
    class="bg-gradient-to-r from-emerald-400 to-green-500 text-gray-900 px-6 py-2.5 rounded-xl shadow-lg hover:opacity-90 transition font-semibold">
    + Tambah Petugas
</button>



        </div>

        <!-- Modal Tambah Petugas -->
        <div x-show="openModal" 
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm"
             style="display: none;">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative">
                <!-- Tombol close -->
                <button @click="openModal = false" 
                        class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>

                <h3 class="text-2xl font-bold mb-6 text-gray-800">Tambah Petugas</h3>

                <form action="{{ route('admin.petugas.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Nama Petugas</label>
                        <input type="text" name="nama_petugas" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" name="username" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" minlength="6" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Telp</label>
                        <input type="text" name="telp" 
                               class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Level</label>
                        <select name="level" 
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" @click="openModal = false" 
                                class="px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                            Batal
                        </button>
                        <button type="submit" 
    class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 text-gray-900 font-semibold shadow hover:opacity-90 transition">
    Simpan
</button>

                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Petugas -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-100 to-indigo-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Nama Petugas</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Telp</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Level</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($petugas as $p)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 text-gray-800">{{ $p->nama_petugas }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $p->username }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $p->telp }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-sm font-medium rounded-full 
                                    {{ $p->level == 'admin' ? 'bg-indigo-100 text-indigo-600' : 'bg-cyan-100 text-cyan-600' }}">
                                    {{ ucfirst($p->level) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
