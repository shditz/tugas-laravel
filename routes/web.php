<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiliController;


// Route::get('/data', function () {
//     return view('data');
// });
Route::get('/userdd', function () {
    return view('user.dashboard');
});

Route::get('/login2', function () {
    return view('user.login2');
});



Route::get('/absenini/search', [AbsenController::class, 'search']);



Route::get('/absenk', function () {
    return view('absenk');
});




Route::get('/rilis/{id}', [RiliController::class, 'show'])->name('rilis.show');

Route::get('/rilis/edit/{id}', [RiliController::class, 'edit'])->name('rilis.edit');


Route::put('/rilis/{id}', [RiliController::class, 'update'])->name('rilis.update');

Route::get('/rilis', [RiliController::class, 'index'])->name('rilis.index');



Route::get('/isirilis', function () {
    return view('isirilis');
});
Route::get('/rilisu', function () {
    return view('user.rilisu');
})->name('rilisu');

Route::resource('rili', RiliController::class);




Route::get('/data', [DataController::class, 'index'])->middleware('auth')->name('data');

Route::resource('users', UserController::class);
Route::post('/users', [UserController::class, 'store'])->name('users.store');




Route::get('/data', [UserController::class, 'index'])->name('users.index');
Route::post('/data', [UserController::class, 'store'])->name('users.store');
Route::delete('/data/{id}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/profile', [ProfileController::class, 'index'])->name('dokumen');


Route::get('/data/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/data/{id}', [UserController::class, 'update'])->name('users.update');





Route::get('/absenini', [AbsenController::class, 'index'])->name('absenini');

// Menyimpan data absen dari form
Route::post('/absenini', [AbsenController::class, 'store'])->name('absen.store');










Route::get('/', function () {
    return redirect()->route('absensi.index1');
});

// Menampilkan form absensi
Route::get('/absensi', [AbsenController::class, 'index1'])->name('absensi.index1');

// Menyimpan data absensi (POST)
Route::post('/absensi', [AbsenController::class, 'store'])->name('absensi.store');








// Route untuk lihat semua profil
Route::get('/dokumen', [ProfileController::class, 'index'])->name('profiles.index');

// 🚨 Tempatkan 'create' SEBELUM '/profiles/{id}'
Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');

// Route untuk simpan data profil
Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');

// Route untuk form edit profil
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

// Route untuk update data profil
Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

// 🚨 Ini di bawah agar tidak konflik
Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');

// Route untuk download PDF
Route::get('/profile/{id}/download', [ProfileController::class, 'download'])->name('profile.download');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'user.dashboard'])->name('dashboard');
});




Route::get('/absensi', function () {
    return view('user.absensi');
});




Route::get('userp', [ProfileController::class, 'create'])->name('profile.create');
Route::post('userp', [ProfileController::class, 'store'])->name('profile.store');








Route::get('/loginp', [UserController::class, 'showLoginForm'])->name('loginp.form'); // untuk tampilkan form
Route::post('/loginp', [UserController::class, 'login'])->name('loginp'); // proses login
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('user.dashboard');
});









Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');






Route::get('/absen/export', [AbsenController::class, 'exportExcel'])->name('absen.export');