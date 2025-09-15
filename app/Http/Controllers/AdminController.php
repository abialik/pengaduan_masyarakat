<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Support\Facades\DB;
use App\Models\Tanggapan;

class AdminController extends Controller
{
    // app/Http/Controllers/AdminController.php

public function dashboard()
{
    $total_pengaduan = Pengaduan::count();
    $pengaduan_proses = Pengaduan::where('status', 'proses')->count();
    $pengaduan_selesai = Pengaduan::where('status', 'selesai')->count();
    $total_petugas = Petugas::count();

    // Data ringkasan (10 terbaru) + daftar lengkap
    $pengaduan_terbaru = Pengaduan::orderBy('tgl_pengaduan', 'desc')->limit(10)->get();
    $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();

    return view('admin.dashboard', compact(
        'total_pengaduan',
        'pengaduan_proses',
        'pengaduan_selesai',
        'total_petugas',
        'pengaduan_terbaru',
        'pengaduan'
    ));
}


    public function pengaduanDetail($id)
    {
       $pengaduan = Pengaduan::where('id_pengaduan', $id)->firstOrFail();
    return view('admin.pengaduan.pengaduan', compact('pengaduan'));
    }

    public function verifikasiPengaduan(Request $request, $id)
        {
            $request->validate([
                'status' => 'required|in:proses,selesai',
                'tanggapan' => 'nullable|string',
            ]);

            $pengaduan = Pengaduan::where('id_pengaduan', $id)->firstOrFail();
            $pengaduan->status = $request->status;
            $pengaduan->save();

            if ($request->filled('tanggapan')) {
                Tanggapan::create([
                    'id_pengaduan' => $id,
                    'tgl_tanggapan' => now(),
                    'tanggapan' => $request->tanggapan,
                    'id_petugas' => auth('admin')->id(),

                ]);
            }

            return redirect()->route('admin.dashboard')->with('success', 'Pengaduan berhasil diverifikasi.');
        }


    public function petugasIndex()
    {
        $petugas = Petugas::all();
        return view('admin.petugas', compact('petugas'));
    }

    public function storePetugas(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:35',
            'username' => 'required|string|max:25|unique:petugas,username',
            'password' => 'required|string|min:6',
            'telp' => 'required|string|max:13',
            'level' => 'required|in:admin,petugas',
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'telp' => $request->telp,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function pengaduanIndex()
{
    $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();
    return view('admin.pengaduan', compact('pengaduan'));
}

public function laporanIndex()
{
    $laporan = Pengaduan::where('status', 'selesai')
        ->orderBy('tgl_pengaduan', 'desc')
        ->get();

    return view('admin.laporan', compact('laporan'));
}

}