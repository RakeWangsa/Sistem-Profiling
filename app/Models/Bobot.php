<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'bobot';
    protected $connection = 'sqlsrv2';

    protected $fillable = ['kode', 'kategori', 'bobot'];
}
