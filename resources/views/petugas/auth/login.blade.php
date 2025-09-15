<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white via-orange-50 to-red-100">

    <div class="w-full max-w-md bg-gradient-to-br from-white via-orange-100 to-red-100 rounded-2xl shadow-xl p-8">
        <!-- Heading -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 flex items-center justify-center mx-auto bg-gradient-to-r from-orange-400 to-red-400 text-white rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2 .895 2 2 2 2-.895 2-2zm-2-9a9 9 0 100 18 9 9 0 000-18z" />
                </svg>
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
                <input type="password" name="password" id="password"
                       class="w-full px-3 py-2 bg-white/80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 outline-none"
                       placeholder="Masukkan password" required>
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:opacity-90 text-white font-semibold py-2.5 rounded-lg shadow-lg transition">
                Login
            </button>
        </form>
    </div>

</body>
</html>
