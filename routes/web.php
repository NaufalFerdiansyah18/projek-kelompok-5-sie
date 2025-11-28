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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');


Route::get('/nama/{param1?}/{nim?}', function ($param1= '', $nim= '') {
    return 'Nama saya: '.$param1. '<br> nim : '.$nim;
});

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeController::class, 'index'])->name ('home');

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard-dasher');
    })->name('dashboard');

    // Pelanggan Routes
    Route::resource('pelanggan', PelangganController::class);
});

// UMKM Routes
Route::resource('umkm', UmkmController::class);

Route::resource('user', UserController::class);

Route::resource('produk', \App\Http\Controllers\ProdukController::class);

Route::resource('warga', \App\Http\Controllers\WargaController::class);
