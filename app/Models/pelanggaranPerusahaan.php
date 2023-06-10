<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggaranPerusahaan extends Model
{
    use HasFactory;
    
    protected $table = 'pelanggaran_perusahaan';
    protected $connection = 'sqlsrv';
    
    public $timestamp = false;

    protected $fillable = ['id_catatan', 'pelanggaran_id','perusahaan_id', 'keterangan'];

    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d',
    // ];
}
