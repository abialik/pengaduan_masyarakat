<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas; // pastikan model ini extends Authenticatable

class AdminAuthController extends Controller
{
    /**
     * Menampilkan halaman login admin
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login admin (tanpa bcrypt)
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username
        $petugas = Petugas::where('username', $request->username)->first();

        // Cek apakah ada user dan password sama persis (plain)
        if ($petugas && $petugas->password === $request->password) {
            Auth::guard('admin')->login($petugas); // login manual tanpa hash
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Berhasil login sebagai admin.');
        }

        // Jika gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', 'Berhasil logout.');
    }
}
