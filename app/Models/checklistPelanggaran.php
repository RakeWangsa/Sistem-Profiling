<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checklistPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'checklist_pelanggaran';
    protected $connection = 'sqlsrv';

    public function pelanggaran()
    {
        return $this->hasMany(pelanggaran::class);
    }
}
