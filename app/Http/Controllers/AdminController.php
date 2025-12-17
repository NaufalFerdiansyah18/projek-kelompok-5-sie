<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Display the pelanggan index page
     */
    public function pelangganIndex()
    {
        // Menggunakan data dari database
        $dataPelanggan = \App\Models\Pelanggan::all();
        return view('admin.pelanggan.index', compact('dataPelanggan'));
    }

    /**
     * Display the pelanggan create page
     */
    public function pelangganCreate()
    {
        return view('admin.pelanggan.create');
    }
}
