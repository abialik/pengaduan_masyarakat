
<div class="h-full flex flex-col justify-between py-6 px-4">
    <div>
        <div class="mb-8 flex items-center gap-2">
            <span class="text-2xl font-bold text-blue-600">Admin Panel</span>
        </div>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2 py-2 px-4 rounded hover:bg-blue-100 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 font-semibold text-blue-600' : 'text-gray-700' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.petugas') }}"
                   class="flex items-center gap-2 py-2 px-4 rounded hover:bg-blue-100 transition {{ request()->routeIs('admin.petugas') ? 'bg-blue-100 font-semibold text-blue-600' : 'text-gray-700' }}">
                    <i class="fas fa-user-shield"></i> Manajemen Petugas
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengaduan') }}"
                   class="flex items-center gap-2 py-2 px-4 rounded hover:bg-blue-100 transition {{ request()->routeIs('admin.pengaduan') ? 'bg-blue-100 font-semibold text-blue-600' : 'text-gray-700' }}">
                    <i class="fas fa-file-alt"></i> Data Pengaduan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.laporan.index') }}"
                   class="flex items-center gap-2 py-2 px-4 rounded hover:bg-blue-100 transition {{ request()->routeIs('admin.laporan.index') ? 'bg-blue-100 font-semibold text-blue-600' : 'text-gray-700' }}">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
            </li>
        </ul>
    </div>
    <div class="mt-8">
        <form action="{{ route('admin.logout') }}" method="POST" class="mt-8">
    @csrf
    <button type="submit" 
        class="flex items-center gap-2 py-2 px-4 rounded hover:bg-red-100 text-red-600 transition w-full text-left">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>

    </div>
</div>