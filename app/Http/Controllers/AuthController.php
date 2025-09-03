<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login; // Jika kamu pakai model Login
use Illuminate\Support\Facades\Auth; // Untuk menggunakan Auth facade

class AuthController extends Controller
{
public function username()
{
    return 'username';
}
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('data');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ]);
    }
     public function showLoginForm()
    {
        return view('user.dashboard'); // Pastikan file auth/login.blade.php ada
    }
}
