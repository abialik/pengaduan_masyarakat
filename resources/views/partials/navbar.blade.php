<nav x-data="{ open: false }" 
     class="bg-white/80 backdrop-blur-md shadow-md sticky top-0 z-50 w-full transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
                        {{-- Logo --}}
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="{{ asset('img/logo.png') }}" 
                            class="h-10 w-10 rounded-full p-1 
                                    bg-gradient-to-br from-blue-500/40 to-orange-500/40 
                                    shadow-md hover:shadow-lg transition duration-500" 
                            alt="Logo">
                        <span class="absolute inset-0 rounded-full ring-2 ring-white/30"></span>
                    </div>
                    <span class="text-xl font-extrabold bg-gradient-to-r from-blue-600 to-orange-500 bg-clip-text text-transparent">
                        Pengaduan Masyarakat
                    </span>
                </div>
                    

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="/" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-blue-600 transition">Tentang</a>
                <a href="#carakerja" class="text-gray-700 hover:text-blue-600 transition">Cara Kerja</a>
            </div>

            {{-- Auth Area (Desktop) --}}
            <div class="hidden md:flex items-center space-x-4 text-sm">
                @auth('masyarakat')
                    <span class="text-gray-700 font-medium">👋 {{ Auth::guard('masyarakat')->user()->nama }}</span>
                    <form method="POST" action="{{ route('masyarakat.logout') }}">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-1.5 rounded-full bg-red-500 text-white hover:bg-red-600 transition shadow">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Masuk</a>
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition shadow">
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Hamburger (Mobile) --}}
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-600 focus:outline-none">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" 
                         class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" 
                         class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition 
         class="md:hidden px-4 pb-4 space-y-2 bg-white/90 backdrop-blur-md shadow-md rounded-b-xl">
        <a href="/" class="block text-gray-700 hover:text-blue-600 transition">Beranda</a>
        <a href="#tentang" class="block text-gray-700 hover:text-blue-600 transition">Tentang</a>
        <a href="#carakerja" class="block text-gray-700 hover:text-blue-600 transition">Cara Kerja</a>
        <hr class="my-2">

        @auth('masyarakat')
            <div class="text-gray-700 font-medium">👋 {{ Auth::guard('masyarakat')->user()->nama }}</div>
            <form method="POST" action="{{ route('masyarakat.logout') }}">
                @csrf
                <button type="submit" 
                        class="block text-left w-full px-3 py-2 rounded-md bg-red-500 text-white hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" 
               class="block text-gray-700 hover:text-blue-600 transition">Masuk</a>
            <a href="{{ route('register') }}"
               class="block w-full text-center bg-blue-600 text-white py-2 rounded-full hover:bg-blue-700 transition shadow">
               Daftar
            </a>
        @endauth
    </div>
</nav>
