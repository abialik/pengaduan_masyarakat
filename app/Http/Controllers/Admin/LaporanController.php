<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use PDF; // package barryvdh/laravel-dompdf

use Maatwebsite\Excel\Facades\Excel; // package maatwebsite/excel
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with('masyarakat')->get();
        return view('admin.laporan.index', compact('pengaduan'));
    }

    public function exportPDF()
    {
        $pengaduan = Pengaduan::with('masyarakat')->get();
        $pdf = PDF::loadView('admin.laporan.pdf', compact('pengaduan'));
        return $pdf->download('laporan_pengaduan.pdf');
    }

    public function exportExcel()
    {
        $pengaduan = Pengaduan::with('masyarakat')->get();

        return Excel::download(new \App\Exports\PengaduanExport($pengaduan), 'laporan_pengaduan.xlsx');
    }
}
