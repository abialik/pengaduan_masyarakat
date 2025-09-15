<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pengaduan Masyarakat') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/d0f5c539f4.js" crossorigin="anonymous"></script>

    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    {{-- AOS CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
</head>

<body class="bg-white text-gray-800 font-['Instrument Sans'] antialiased">
    {{-- Navbar --}}
    <nav 
        x-data="{ scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'bg-white/80 backdrop-blur-md shadow-md' : 'bg-transparent'"
        class="sticky top-0 z-50 w-full transition-all duration-500 ease-in-out"
    >
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            {{-- Logo --}}
            <div class="flex items-center gap-3 transition-all duration-500"
                 :class="scrolled ? 'scale-90' : 'scale-100'">
                <div class="relative">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo"
                         class="w-12 h-12 rounded-full p-1 
                                bg-gradient-to-br from-blue-500/40 to-purple-500/40 
                                shadow-lg shadow-blue-500/20 
                                hover:shadow-blue-500/40 transition duration-500">
                    <span class="absolute inset-0 rounded-full ring-2 ring-white/30"></span>
                </div>
                <span class="text-xl font-bold text-gray-800">Pengaduan Masyarakat</span>
            </div>

            {{-- Menu kanan --}}
            <div class="flex items-center gap-4 text-sm">
                @auth('masyarakat')
                    <span class="text-gray-700">👋 Halo, {{ Auth::guard('masyarakat')->user()->nama }}</span>
                    <form action="{{ route('masyarakat.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('masyarakat.login') }}" class="text-blue-600 hover:underline">Login</a>
                    <a href="{{ route('masyarakat.register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-1 rounded shadow">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 1200,
        once: true,
        offset: 100
      });
    </script>
</body>
</html>
