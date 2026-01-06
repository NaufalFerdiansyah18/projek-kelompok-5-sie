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
use App\Http\Controllers\PesananController;
use App\Http\Controllers\UlasanProdukController;

Route::get('/', function () {
    return redirect()->route('auth');
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


Route::get('auth', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/store', [AuthController::class, 'store'])->name('auth.store');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::group(['middleware' => ['checkrole:Super Admin']], function () {

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('pesanan', PesananController::class);
        Route::resource('ulasan', UlasanProdukController::class)->only(['index','create','store']);

        Route::resource('umkm', UmkmController::class);
        Route::resource('user', UserController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('warga', WargaController::class);

    });

});
