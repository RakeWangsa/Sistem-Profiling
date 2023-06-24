<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info_perusahaan extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'info_perusahaan';
    protected $connection = 'sqlsrv';

    protected $fillable = ['id_trader','nama_pemilik', 'al_instalasi', 'komoditas', 'jenis_kegiatan', 'upt_bkipm'];
}
