<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
<<<<<<< HEAD:projek-kelompok-5-sie-main/app/Http/Controllers/ProductController.php
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // server-side pagination Laravel
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
=======
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * (index) Menampilkan daftar produk
     * * PERBAIKAN: Menggunakan view 'admin.products.index'
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        // Menggunakan path view admin yang benar
        return view('admin.products.index', compact('products'));
    }

    /**
     * (create) Menampilkan form tambah produk
     *
     * PERBAIKAN: Menggunakan view 'admin.products.create'
     */
    public function create(): View
    {
        // Menggunakan path view admin yang benar
        return view('admin.products.create');
    }

    /**
     * (store) Menyimpan produk ke database
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name'  => 'required|string|min:3',
            'price' => 'required|integer'
        ]);

        // Buat produk baru
        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description
        ]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
         // Anda bisa buat view 'admin.products.show' jika perlu
        return view('admin.products.show', compact('product'));
    }

    /**
     * (edit) Menampilkan form edit produk
     *
     * PERBAIKAN: Menggunakan view 'admin.products.edit'
     */
    public function edit(Product $product): View
    {
        // Menggunakan path view admin yang benar
        return view('admin.products.edit', compact('product'));
    }

    /**
     * (update) Update produk
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name'  => 'required|string|min:3',
            'price' => 'required|integer'
        ]);

        // Update produk
        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description
        ]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * (destroy) Hapus produk
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Hapus produk
        $product->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil dihapus.');
>>>>>>> 8ee3eca1881170163d8a7d025f44bb2d7f8931a4:laravel-web/app/Http/Controllers/ProductController.php
    }
}
