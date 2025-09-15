<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a2d04cb14b.js" crossorigin="anonymous"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50">
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <!-- Logo / Title -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center w-16 h-16 mx-auto bg-orange-500 text-white rounded-full shadow-md">
                <i class="fas fa-user-shield text-2xl"></i>
            </div>
            <h2 class="mt-4 text-2xl font-bold text-gray-800">Login Admin</h2>
            <p class="text-sm text-gray-500">Silakan masuk ke panel admin</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Username -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="username" 
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none"
                        placeholder="Masukkan username" required autofocus>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" 
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none"
                        placeholder="Masukkan password" required>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                class="w-full bg-orange-500 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 transition">
                Masuk
            </button>
        </form>

        <!-- Footer -->
        <p class="mt-6 text-xs text-center text-gray-400">
            © {{ date('Y') }} Sistem Pengaduan | Admin Panel
        </p>
    </div>

</body>
</html>
