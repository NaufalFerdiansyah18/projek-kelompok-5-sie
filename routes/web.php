<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

Route::get('/nama/{param1?}/{nim?}', function ($param1 = '', $nim = '') {
    return 'Nama saya: ' . $param1 . '<br> nim : ' . $nim;
});

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');

// ================================
// 🔐 ROUTE LOGIN
// ================================
Route::get('auth', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// ================================
// 🔥 ADMIN AREA (PROTECTED)
// Hanya Super Admin yang bisa mengakses dashboard
// ================================
Route::group(['middleware' => ['checkrole:Super Admin']], function () {

    Route::prefix('admin')->name('admin.')->group(function () {

        // 🔒 Dashboard hanya untuk Super Admin
        Route::get('/dashboard', function () {
            return view('admin.dashboard-dasher');
        })->name('dashboard');

        // Resource pelanggan (jika perlu ikut dilindungi)
        Route::resource('pelanggan', PelangganController::class);

    });

});

// ==============================
// ROUTE LAIN TANPA MIDDLEWARE
// ==============================
Route::resource('umkm', UmkmController::class);
Route::resource('user', UserController::class);
Route::resource('produk', ProdukController::class);
Route::resource('warga', WargaController::class);
