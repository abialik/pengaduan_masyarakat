<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan'; // atau 'tb_pengaduan' kalau di DB namanya itu

    protected $primaryKey = 'id_pengaduan'; // 👈 ini wajib

    public $incrementing = true; // karena auto_increment
    protected $keyType = 'int'; // tipe PK

    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'isi_laporan',
        'foto',
        'status',
    ];

    public $timestamps = false;

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduan');
    }
}
