<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        // ambil semua pengaduan milik user yang login
        $pengaduans = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->get();

        return view('masyarakat.dashboard', compact('pengaduans'));
    }
}
