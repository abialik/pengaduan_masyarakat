<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pengaduan Masyarakat') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Tailwind CDN fallback --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/d0f5c539f4.js" crossorigin="anonymous"></script>

    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>

<body class="bg-white text-gray-800 font-['Instrument Sans'] antialiased">
    {{-- Navbar --}}
    <nav class="bg-white border-b shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 h-10">
            <span class="text-lg font-bold text-gray-800">Pengaduan Masyarakat</span>
        </div>

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
                <a href="{{ route('masyarakat.register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-1 rounded">
                    Daftar
                </a>
            @endauth
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')
</body>
</html>
