@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Form Registrasi Masyarakat</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('masyarakat.register') }}" method="POST">
        @csrf

        <input type="text" name="nik" placeholder="NIK" class="w-full mb-3 p-2 border rounded" value="{{ old('nik') }}" required>
        <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 p-2 border rounded" value="{{ old('nama') }}" required>
        <input type="text" name="username" placeholder="Username" class="w-full mb-3 p-2 border rounded" value="{{ old('username') }}" required>
        <input type="text" name="telp" placeholder="No. Telepon" class="w-full mb-3 p-2 border rounded" value="{{ old('telp') }}" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full mb-3 p-2 border rounded" required>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Daftar</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('masyarakat.login') }}" class="text-blue-500 hover:underline">Sudah punya akun? Login</a>
    </div>
</div>
@endsection
