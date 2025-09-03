<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $table = 'logins';  // Pastikan ini sesuai nama tabel di database kamu
    protected $fillable = ['username', 'password'];

    protected $hidden = ['password']; // Sembunyikan password saat serialisasi
}
