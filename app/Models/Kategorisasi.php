<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorisasi extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'kepatuhan';
    protected $connection = 'sqlsrv2';

    protected $fillable = ['id_trader','kode', 'verifikasi1', 'verifikasi2', 'verifikasi3', 'nilai'];
}
