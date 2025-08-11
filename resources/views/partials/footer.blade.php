<footer class="bg-gray-100 border-t py-12 px-6 mt-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-sm text-gray-700">
        
        {{-- Branding --}}
        <div>
            <div class="flex items-center gap-2 mb-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-8 object-contain">
                <h4 class="text-lg font-semibold text-gray-800">Pengaduan Masyarakat</h4>
            </div>
            <p class="text-xs text-gray-500">© {{ date('Y') }} All rights reserved.</p>
            <div class="flex space-x-3 mt-4 text-lg text-gray-500">
                <a href="#"><i class="fab fa-facebook hover:text-blue-600 transition"></i></a>
                <a href="#"><i class="fab fa-twitter hover:text-blue-400 transition"></i></a>
                <a href="#"><i class="fab fa-linkedin hover:text-blue-700 transition"></i></a>
            </div>
        </div>

        {{-- Menu --}}
        <div>
            <h4 class="font-semibold text-blue-600 mb-2">Menu</h4>
            <ul class="space-y-1">
                <li><a href="/" class="hover:text-blue-500 transition">Beranda</a></li>
                <li><a href="#tentang" class="hover:text-blue-500 transition">Tentang</a></li>
                <li><a href="#carakerja" class="hover:text-blue-500 transition">Cara Kerja</a></li>
            </ul>
        </div>

        {{-- Kontak --}}
        <div>
            <h4 class="font-semibold text-blue-600 mb-2">Kontak</h4>
            <ul class="space-y-1">
                <li><a href="mailto:pengaduan_masyarakat.com" class="hover:text-blue-500 transition">pengaduanmasyarakat.com</a></li>
                <li><a href="https://wa.me/62895347920306" class="hover:text-blue-500 transition" target="_blank">WhatsApp</a></li>
            </ul>
        </div>

        {{-- Bantuan --}}
        <div>
            <h4 class="font-semibold text-blue-600 mb-2">Bantuan</h4>
            <ul class="space-y-1">
                <li><a href="#" class="hover:text-blue-500 transition">Pusat Bantuan</a></li>
                <li><a href="#faq" class="hover:text-blue-500 transition">FAQ</a></li>
            </ul>
        </div>
    </div>
</footer>
