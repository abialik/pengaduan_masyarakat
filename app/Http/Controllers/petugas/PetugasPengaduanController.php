<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PetugasPengaduanController extends Controller
{
    /**
     * Tampilkan semua pengaduan untuk dashboard petugas
     */
    public function index()
    {
        $pengaduan = Pengaduan::with('masyarakat')->latest()->get();
        return view('petugas.dashboard', compact('pengaduan'));
    }

    /**
     * Verifikasi pengaduan (ubah status jadi 'proses')
     */
    public function verifikasi($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status !== '0') { // 0 = belum diverifikasi
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Pengaduan sudah diverifikasi.');
        }

        $pengaduan->status = 'proses';
        $pengaduan->save();

        return redirect()->route('petugas.dashboard')
            ->with('success', 'Pengaduan berhasil diverifikasi!');
    }
}
