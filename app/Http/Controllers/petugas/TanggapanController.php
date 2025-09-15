<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    // Detail pengaduan + form tanggapan
    public function show($id)
    {
        $pengaduan = Pengaduan::with('tanggapan')->findOrFail($id);

        return view('petugas.tanggapan.show', compact('pengaduan'));
    }

    // Simpan tanggapan
    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string|max:255',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->tanggapan()->create([
            'tanggapan' => $request->tanggapan,
            'tgl_tanggapan' => now(),
            'id_petugas' => auth()->guard('petugas')->id(),
        ]);

        $pengaduan->update(['status' => 'selesai']);

        return redirect()->route('petugas.pengaduan.index')
            ->with('success', 'Tanggapan berhasil dikirim.');
    }
}
