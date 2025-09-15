<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengaduanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Ambil hanya yang status selesai (sesuai menu laporan admin)
        return Pengaduan::with('masyarakat')
            ->where('status', 'selesai')
            ->orderBy('tgl_pengaduan', 'desc')
            ->get();
    }

    // Tambahkan heading untuk file Excel
    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'NIK',
            'Nama',
            'Isi Laporan',
            'Status',
        ];
    }

    // Mapping data tiap baris
    public function map($pengaduan): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $pengaduan->tgl_pengaduan,
            $pengaduan->nik,
            $pengaduan->masyarakat->nama ?? '-',
            $pengaduan->isi_laporan,
            $pengaduan->status == '0' ? 'Belum Ditanggapi' : ucfirst($pengaduan->status),
        ];
    }
}
