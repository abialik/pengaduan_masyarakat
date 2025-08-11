<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('masyarakat.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'password' => 'required',
        ]);

        $user = Masyarakat::where('nik', $request->nik)->first();

        if ($user && $user->password === $request->password) {
            Auth::guard('masyarakat')->login($user);

            // Cek apakah login berhasil
            // dd(Auth::guard('masyarakat')->check()); // Harusnya TRUE

      return redirect()->route('masyarakat.dashboard');

        }

        return back()->withErrors(['login' => 'NIK atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        return redirect()->route('masyarakat.login');
    }
}
