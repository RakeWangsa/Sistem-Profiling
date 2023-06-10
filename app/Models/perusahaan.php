<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    use HasFactory;

    protected $table = 'tb_r_trader';
    protected $primaryKey = 'id_trader';
    protected $connection = 'sqlsrv2';

    public function sertifikat()
    {
       return $this->belongsToMany(sertifikat::class, 'sertfikasi');
    }

    public function pelanggaran()
    {
        return $this->belongsToMany(pelanggaran::class, 'pelanggaran_perusahaan', 'perusahaan_id', 'pelanggaran_id');
    }
}
