<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function create()
    {
        return view('masyarakat.pengaduan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pengaduan = new Pengaduan();
        $pengaduan->nik = Auth::guard('masyarakat')->user()->nik;
        $pengaduan->tgl_pengaduan = now();
        $pengaduan->isi_laporan = $request->isi_laporan;
        $pengaduan->status = '0';

        if ($request->hasFile('foto')) {
            $pengaduan->foto = $request->file('foto')->store('foto', 'public');
        }

        $pengaduan->save();

        return redirect()->route('masyarakat.dashboard')->with('success', 'Laporan berhasil dikirim.');
    }

    public function dashboard()
    {
        $nik = Auth::guard('masyarakat')->user()->nik;
        $pengaduans = Pengaduan::where('nik', $nik)->latest()->get();

        return view('landing', compact('pengaduans'));
    }
}
