<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakananKhas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'daerah',
        'deskripsi',
        'gambar',
    ];

    protected $table = 'makanan_khas';
}
