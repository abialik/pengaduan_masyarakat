<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasAuthController extends Controller
{
    // Form login
    public function showLoginForm()
    {
        return view('petugas.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('petugas')->attempt($credentials)) {
            return redirect()->route('petugas.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah!',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('petugas')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('petugas.login');
    }
}
