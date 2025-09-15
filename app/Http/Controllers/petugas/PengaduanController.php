<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class PengaduanController extends Controller
{
    // Menampilkan daftar pengaduan untuk petugas
    public function index()
    {
        $pengaduan = Pengaduan::latest()->paginate(10);
        return view('petugas.tanggapan.index', compact('pengaduan'));
    }

    // Verifikasi pengaduan (ubah status jadi "proses")
    public function verifikasi($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // Jika status masih 0 (baru), ubah jadi proses
        if ($pengaduan->status === '0') {
            $pengaduan->status = 'proses';
            $pengaduan->save();
        }

        return redirect()->route('petugas.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diverifikasi.');
    }

    // Memberikan tanggapan & ubah status jadi "selesai"
    public function tanggapan(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string|max:255',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // Simpan tanggapan
        Tanggapan::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => auth()->guard('petugas')->id(), // ambil id petugas login
        ]);

        // Ubah status jadi selesai
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        return redirect()->route('petugas.pengaduan.index')
            ->with('success', 'Tanggapan berhasil dikirim dan pengaduan selesai.');
    }
}
