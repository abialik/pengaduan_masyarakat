<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2d04cb14b.js" crossorigin="anonymous"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white via-orange-50 to-red-100">

    <div class="w-full max-w-md bg-gradient-to-br from-white via-orange-100 to-red-100 rounded-2xl shadow-xl p-8" data-aos="zoom-in">
        <!-- Heading -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 flex items-center justify-center mx-auto bg-gradient-to-r from-orange-400 to-red-400 text-white rounded-full shadow-md">
                <i class="fas fa-user-tie"></i>
            </div>
            <h2 class="mt-4 text-2xl font-bold">Login Petugas</h2>
            <p class="text-sm">Masukkan username dan password anda</p>
        </div>

        {{-- Error Message --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-600 px-4 py-2 rounded-lg mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('petugas.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm mb-1">Username</label>
                <input type="text" name="username" id="username"
                       class="w-full px-3 py-2 bg-white/80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 outline-none"
                       placeholder="Masukkan username" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                           class="w-full px-3 py-2 bg-white/80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 outline-none"
                           placeholder="Masukkan password" required>
                    <button type="button" onclick="togglePassword('password','toggleIconPetugas')" 
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <i id="toggleIconPetugas" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:opacity-90 text-white font-semibold py-2.5 rounded-lg shadow-lg transition">
                Login
            </button>
        </form>
    </div>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out'
        });

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
