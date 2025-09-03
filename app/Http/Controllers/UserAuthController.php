<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    /**
     * Tampilkan form login karyawan
     */
    public function showLoginForm()
    {
        return view('user.loginp'); // pastikan view ada di resources/views/user/loginp.blade.php
    }

    /**
     * Proses login karyawan
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'jabatan' => 'required|string',
            'jeniskelamin' => 'required|string|in:Laki-laki,Perempuan',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('user')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/userd'); // ganti sesuai halaman setelah login
        }

        return back()->withErrors([
            'login_error' => 'Username atau password salah.',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.loginp'); // ganti dengan nama route login user
    }
}
