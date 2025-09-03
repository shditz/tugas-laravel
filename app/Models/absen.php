<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

     protected $table = 'absens';  // Sesuaikan dengan nama tabelmu
    protected $fillable = [
        'nama',
        'status',
        'waktu',
        'tanggal',
        'lokasi',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];
}
