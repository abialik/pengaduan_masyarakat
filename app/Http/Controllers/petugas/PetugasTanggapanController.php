<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PetugasTanggapanController extends Controller
{
    /**
     * Tampilkan detail pengaduan + form tanggapan
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapan'])->findOrFail($id);
        return view('petugas.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Simpan tanggapan dari petugas
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string|max:255',
        ]);

        try {
            // Cek apakah sudah ada tanggapan
            $cekTanggapan = Tanggapan::where('id_pengaduan', $id)->first();
            if ($cekTanggapan) {
                return redirect()->route('petugas.pengaduan.show', $id)
                    ->with('error', 'Pengaduan ini sudah pernah ditanggapi.');
            }

            // Simpan tanggapan
            Tanggapan::create([
                'id_pengaduan' => $id,
                'id_petugas'   => Auth::guard('petugas')->id(),
                'tgl_tanggapan'=> now(),
                'tanggapan'    => $request->tanggapan,
            ]);

            // Update status pengaduan jadi selesai
            Pengaduan::where('id_pengaduan', $id)->update([
                'status' => 'selesai'
            ]);

            return redirect()->route('petugas.pengaduan.show', $id)
                ->with('success', 'Tanggapan berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->route('petugas.pengaduan.show', $id)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
