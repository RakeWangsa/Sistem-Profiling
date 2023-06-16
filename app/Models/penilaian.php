<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'penilaian';
    protected $connection = 'sqlsrv';

    protected $fillable = ['id_trader', 'skor', 'pengurangan', 'total'];
}
