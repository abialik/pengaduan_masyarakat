<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
        'status'       => 'required|in:proses,selesai',
        'tanggapan'    => 'required|string|max:255',
    ]);

    // Update status pengaduan
    Pengaduan::where('id_pengaduan', $request->id_pengaduan)
        ->update(['status' => $request->status]);

    // Ambil user dari guard admin
    $petugas = auth()->guard('admin')->user();

    // Simpan tanggapan
    Tanggapan::create([
        'id_pengaduan' => $request->id_pengaduan,
        'tanggapan'    => $request->tanggapan,
        'tgl_tanggapan'=> now(),
        'id_petugas'   => $petugas->id_petugas,
    ]);

    return redirect()->back()->with('success', 'Tanggapan berhasil dikirim.');
}

}
