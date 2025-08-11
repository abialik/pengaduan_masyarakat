<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('masyarakat.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:masyarakat',
            'nama' => 'required',
            'username' => 'required|unique:masyarakat',
            'telp' => 'required',
            'password' => 'required|confirmed'
        ]);

        Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'telp' => $request->telp,
            'password' => $request->password, // ⛔️ DISIMPAN TANPA HASH
        ]);

        return redirect()->route('masyarakat.login')->with('success', 'Akun berhasil dibuat');
    }
}
