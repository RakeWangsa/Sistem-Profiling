<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';
    protected $connection = 'sqlsrv';

    public function perusahaan()
    {
        return $this->belongsToMany(perusahaan::class, 'pelanggaran_perusahaan');
    }

    public function kriteria()
    {
        return $this->belongsTo(checklistPelanggaran::class, 'checklist_id');
    }
}
