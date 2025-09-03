<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller

{
 
    
public function showLoginForm()
    {
        return view('user.loginp'); // pastikan file resources/views/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->has('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // sesuaikan redirect setelah login sukses
        }

        return back()->withErrors([
            'login_error' => 'Username atau password salah.',
        ])->withInput();
    }
    public function username()
{
    return 'username';
}


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginp');
    }





















    // Contoh register (optional)
    public function register()
    {
        return view('user.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'jabatan' => 'required|string',
            'jeniskelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        User::create([
            'username' => $request->username,
            'password' => $request->password, // otomatis hash oleh mutator di model
            'jabatan' => $request->jabatan,
            'jeniskelamin' => $request->jeniskelamin,
        ]);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil, silakan login.');
    }
    


















    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all(); // Mengambil semua pengguna dari database
        return view('data', compact('users')); // Mengembalikan view dengan data pengguna
    }
    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'jabatan' => 'required|string',
            'jeniskelamin' => 'required|string|in:Laki-laki,Perempuan',
        ]);
        // Membuat pengguna baru
        User::create([
        'username' => $request->username,
        'password' => $request->password,
        'jabatan' => $request->jabatan,
        'jeniskelamin' => $request->jeniskelamin,
        ]);

            
        return redirect()->back()->with('success', 'User  berhasil ditambahkan.');
    }
    
    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
        $user->delete(); // Menghapus pengguna
        return redirect()->back()->with('success', 'User  berhasil dihapus.');
    }









    ///batas
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('edit-user', compact('user')); // Pastikan view 'edit-user.blade.php' ada
}

public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'jabatan' => 'required|string',
        'jeniskelamin' => 'required|string|in:Laki-laki,Perempuan',
        'password' => 'nullable|string|min:6'
    ]);

    $user = User::findOrFail($id);

    // Update field lain
    $user->update([
        'username' => $request->username,
        'jabatan' => $request->jabatan,
        'jeniskelamin' => $request->jeniskelamin,
    ]);

    // Jika password diisi, update juga password-nya
    if ($request->filled('password')) {
        $user->update([
            'password' => Hash::make($request->password)
        ]);
    }

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
}




//



}