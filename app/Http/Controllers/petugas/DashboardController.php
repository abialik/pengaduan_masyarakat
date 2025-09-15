<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        // Menampilkan pengaduan terbaru untuk diverifikasi/ditanggapi
        $pengaduan = Pengaduan::latest()->paginate(10);

        return view('petugas.dashboard', compact('pengaduan'));
    }
}
