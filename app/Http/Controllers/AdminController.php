<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total_pengaduan = Pengaduan::count();
        $pengaduan_proses = Pengaduan::where('status', 'proses')->count();
        $pengaduan_selesai = Pengaduan::where('status', 'selesai')->count();
        $total_petugas = Petugas::count();
        $pengaduan_terbaru = Pengaduan::orderBy('tgl_pengaduan', 'desc')->limit(10)->get();

        return view('admin.dashboard', [
            'total_pengaduan' => $total_pengaduan,
            'pengaduan_proses' => $pengaduan_proses,
            'pengaduan_selesai' => $pengaduan_selesai,
            'total_petugas' => $total_petugas,
            'pengaduan_terbaru' => $pengaduan_terbaru,
        ]);
    }
}
