<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Umkm;
use App\Models\Produk;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalUmkm = Umkm::count();
        $totalProducts = Produk::count();
        
        // Recent activity: Latest 5 users
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard-dasher', compact('totalUsers', 'totalUmkm', 'totalProducts', 'recentUsers'));
    }

    /**
     * Display the admin dashboard (legacy)
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
