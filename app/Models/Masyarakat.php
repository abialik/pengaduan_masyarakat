<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table = 'masyarakat';
    protected $primaryKey = 'nik';         // ✅ karena nik adalah PK kamu
    public $incrementing = false;          // ✅ karena nik bukan auto-increment
    protected $keyType = 'string';         // ✅ karena nik bertipe CHAR(16)

    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'telp',
    ];

    protected $hidden = [
        'password',         // ✅ sembunyikan password di response
        'remember_token',
    ];
}
