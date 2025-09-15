<div class="h-full flex flex-col justify-between py-6 px-4">
    <div>
        <div class="mb-8 flex items-center gap-2">
            <span class="text-2xl font-bold text-green-600">Petugas Panel</span>
        </div>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('petugas.dashboard') }}"
                   class="flex items-center gap-2 py-2 px-4 rounded hover:bg-green-100 transition {{ request()->routeIs('petugas.dashboard') ? 'bg-green-100 font-semibold text-green-600' : 'text-gray-700' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('petugas.pengaduan.index') }}"
                   class="flex items-center gap-2 py-2 px-4 rounded hover:bg-green-100 transition {{ request()->routeIs('petugas.pengaduan.*') ? 'bg-green-100 font-semibold text-green-600' : 'text-gray-700' }}">
                    <i class="fas fa-file-alt"></i> Data Pengaduan
                </a>
            </li>
        </ul>
    </div>
    <div class="mt-8">
        <form action="{{ route('petugas.logout') }}" method="POST">
            @csrf
            <button type="submit" 
                class="flex items-center gap-2 py-2 px-4 rounded hover:bg-red-100 text-red-600 transition w-full text-left">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>
