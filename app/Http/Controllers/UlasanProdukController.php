<?php

namespace App\Http\Controllers;

use App\Models\UlasanProduk;
use App\Models\Produk;
use App\Models\Warga;
use Illuminate\Http\Request;

class UlasanProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = UlasanProduk::with(['produk', 'warga'])->orderByDesc('ulasan_id');

        $search = $request->input('search');
        $query->search($search);

        if ($request->filled('rating')) {
            $query->where('rating', (int) $request->input('rating'));
        }

        $filters = [
            'search' => $search,
            'rating' => $request->input('rating'),
        ];

        $activeFilters = array_filter($filters, fn ($value) => $value !== null && $value !== '');

        $data['dataUlasan'] = $query->paginate(10)->appends($activeFilters);
        $data['filters'] = $filters;

        return view('admin.ulasan.index', $data);
    }

    public function create()
    {
        $data['produk'] = Produk::orderBy('nama_produk')->get();
        $data['warga'] = Warga::orderBy('nama')->get();
        return view('admin.ulasan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        UlasanProduk::create($request->only('produk_id', 'warga_id', 'rating', 'komentar'));

        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil ditambahkan.');
    }
}
