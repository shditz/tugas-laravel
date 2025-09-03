<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rili extends Model
{
   
    protected $table = 'rilis';

    protected $fillable = [
        'nama',
        'jabatan',
        'judul',
        'status',
        'pesan',
        'foto', // tambahkan ini
    ];





    public function index()
{
    $data = Rili::select('nama','jabatan','judul','status','created_at'); // ambil semua data dari tabel rilis
    return view('rilis', compact('data')); // sesuaikan nama view kamu
}
}

