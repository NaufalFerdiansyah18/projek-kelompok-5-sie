<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmkmController;

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

Route::resource('pelanggan', PelangganController::class);

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/pelanggan', [AdminController::class, 'pelangganIndex'])->name('pelanggan.index');
    Route::get('/pelanggan/create', [AdminController::class, 'pelangganCreate'])->name('pelanggan.create');
});

// UMKM Routes
Route::resource('umkm', UmkmController::class);
