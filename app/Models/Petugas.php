<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    public $timestamps = false;
    protected $fillable = [
        'nama_petugas', 'username', 'password', 'telp', 'level'
    ];
}
