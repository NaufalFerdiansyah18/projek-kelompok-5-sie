<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Tampilkan daftar produk dengan pagination
     */
    public function index(Request $request)
    {
        $query = Produk::with('umkm')->latest();

        $search = $request->input('search');
        $query->search($search);

        $filters = [
            'search' => $search,
        ];

        $activeFilters = array_filter($filters, fn ($value) => $value !== null && $value !== '');

        $produk = $query->paginate(10)->appends($activeFilters);

        return view('produk.index', compact('produk', 'filters'));
    }

    /**
     * Tampilkan form tambah produk baru
     */
    public function create()
    {
        $umkm = Umkm::all(); // untuk dropdown pemilihan UMKM
        return view('produk.create', compact('umkm'));
    }

    /**
     * Simpan produk baru ke database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'umkm_id' => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail produk
     */
    public function show(Produk $produk)
    {
        $produk->load('umkm');
        return view('produk.show', compact('produk'));
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit(Produk $produk)
    {
        $umkm = Umkm::all();
        return view('produk.edit', compact('produk', 'umkm'));
    }

    /**
     * Update data produk
     */
    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'umkm_id' => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Hapus gambar lama jika diganti
        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('uploads/produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
