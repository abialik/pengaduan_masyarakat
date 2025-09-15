<footer class="bg-gradient-to-br from-gray-100 via-white to-gray-100 border-t pt-12 px-6 mt-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-sm text-gray-700">
        
        {{-- Branding --}}
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="relative">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="Logo" 
                         class="h-10 w-10 rounded-full p-1 bg-gradient-to-br from-blue-500/40 to-orange-500/40 shadow-md">
                    <span class="absolute inset-0 rounded-full ring-2 ring-white/30"></span>
                </div>
                <h4 class="text-lg font-extrabold bg-gradient-to-r from-blue-600 to-orange-500 bg-clip-text text-transparent">
                    Pengaduan Masyarakat
                </h4>
            </div>
            <p class="text-xs text-gray-500">© {{ date('Y') }} Pengaduan Masyarakat. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 text-xl text-gray-400">
                <a href="#" class="hover:text-blue-600 transition"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-blue-700 transition"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        {{-- Menu --}}
        <div>
            <h4 class="font-semibold text-blue-600 mb-3">Menu</h4>
            <ul class="space-y-2">
                <li><a href="/" class="hover:text-blue-500 transition">Beranda</a></li>
                <li><a href="#tentang" class="hover:text-blue-500 transition">Tentang</a></li>
                <li><a href="#carakerja" class="hover:text-blue-500 transition">Cara Kerja</a></li>
            </ul>
        </div>

        {{-- Kontak --}}
        <div>
            <h4 class="font-semibold text-blue-600 mb-3">Kontak</h4>
            <ul class="space-y-2">
                <li><a href="mailto:pengaduan_masyarakat.com" class="hover:text-blue-500 transition">pengaduanmasyarakat.com</a></li>
                <li><a href="https://wa.me/62895347920306" class="hover:text-blue-500 transition" target="_blank">WhatsApp</a></li>
            </ul>
        </div>

        {{-- Bantuan --}}
        <div>
            <h4 class="font-semibold text-blue-600 mb-3">Bantuan</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-blue-500 transition">Pusat Bantuan</a></li>
                <li><a href="#faq" class="hover:text-blue-500 transition">FAQ</a></li>
            </ul>
        </div>
    </div>
{{-- Bottom divider --}}
<div class="border-t mt-10 pt-4 text-center text-xs text-gray-500">
    © {{ date('Y') }} Pengaduan Masyarakat | Semua Hak Dilindungi
</div>

</footer>
