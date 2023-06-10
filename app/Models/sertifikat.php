<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat';
    protected $connection = 'sqlsrv';

    public function perusahaan()
    {
        return $this->belongsToMany(perusahaan::class, 'sertfikasi');
    }
}
