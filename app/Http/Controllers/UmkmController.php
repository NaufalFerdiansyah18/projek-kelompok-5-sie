<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUmkm'] = Umkm::all();
        return view('admin.umkm.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:200',
            'pemilik_warga_id' => 'required|integer',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kategori' => 'required|string|max:100',
            'kontak' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'logo_foto_usaha' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('logo_foto_usaha')) {
            $file = $request->file('logo_foto_usaha');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('umkm', $filename, 'public');
            $data['logo_foto_usaha'] = $path;
        }

        Umkm::create($data);

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataUmkm'] = Umkm::findOrFail($id);
        return view('admin.umkm.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUmkm'] = Umkm::findOrFail($id);
        return view('admin.umkm.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:200',
            'pemilik_warga_id' => 'required|integer',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kategori' => 'required|string|max:100',
            'kontak' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'logo_foto_usaha' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $umkm = Umkm::findOrFail($id);
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('logo_foto_usaha')) {
            // Delete old file if exists
            if ($umkm->logo_foto_usaha) {
                Storage::disk('public')->delete($umkm->logo_foto_usaha);
            }
            
            $file = $request->file('logo_foto_usaha');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('umkm', $filename, 'public');
            $data['logo_foto_usaha'] = $path;
        }

        $umkm->update($data);

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $umkm = Umkm::findOrFail($id);
        
        // Delete file if exists
        if ($umkm->logo_foto_usaha) {
            Storage::disk('public')->delete($umkm->logo_foto_usaha);
        }
        
        $umkm->delete();

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil dihapus!');
    }
}
