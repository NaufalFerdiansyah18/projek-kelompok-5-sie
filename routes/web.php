<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;

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

// AdminLTE Test Route
Route::get('/adminlte-test', function () {
    return view('admin.adminlte-test');
})->name('adminlte.test');

Route::resource('products', \App\Http\Controllers\ProductController::class);


// Rute untuk Homepage (/)
Route::get('/', function () {
    return view('koppee.index'); // <-- Memanggil views/koppee/index.blade.php
});

// Rute untuk halaman 'About' (/about)
Route::get('/about', function () {
    return view('koppee.about'); // <-- Memanggil views/koppee/about.blade.php
});

// Rute untuk halaman 'Contact' (/contact)
Route::get('/contact', function () {
    return view('koppee.contact');
});

// Rute untuk halaman 'Menu' (/menu)
Route::get('/menu', function () {
    return view('koppee.menu');
});

// Rute untuk halaman 'Reservation' (/reservation)
Route::get('/reservation', function () {
    return view('koppee.reservation');
});

// Rute untuk halaman 'Service' (/service)
Route::get('/service', function () {
    return view('koppee.service');
});

// Rute untuk halaman 'Testimonial' (/testimonial)
Route::get('/testimonial', function () {
    return view('koppee.testimonial');
});
