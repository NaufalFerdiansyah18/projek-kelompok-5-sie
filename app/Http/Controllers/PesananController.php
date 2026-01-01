<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use App\Models\Warga;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('warga')->orderByDesc('pesanan_id');

        $search = $request->input('search');
        $query->search($search);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $filters = [
            'search' => $search,
            'status' => $request->input('status'),
        ];

        $activeFilters = array_filter($filters, fn ($value) => $value !== null && $value !== '');

        $data['dataPesanan'] = $query->paginate(10)->appends($activeFilters);
        $data['filters'] = $filters;

        return view('admin.pesanan.index', $data);
    }

    public function create()
    {
        $data['warga'] = Warga::orderBy('nama')->get();
        $data['produk'] = Produk::orderBy('nama_produk')->get();
        return view('admin.pesanan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'alamat_kirim' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'metode_bayar' => 'nullable|string|max:50',
            'status' => 'required|string|max:50',
            'produk_id.*' => 'nullable|exists:produk,produk_id',
            'qty.*' => 'nullable|integer|min:1',
            'harga_satuan.*' => 'nullable|numeric|min:0',
        ]);

        $pesanan = new Pesanan();
        $pesanan->nomor_pesanan = 'ORD-' . now()->format('YmdHis');
        $pesanan->warga_id = $request->warga_id;
        $pesanan->alamat_kirim = $request->alamat_kirim;
        $pesanan->rt = $request->rt;
        $pesanan->rw = $request->rw;
        $pesanan->metode_bayar = $request->metode_bayar;
        $pesanan->status = $request->status;
        $pesanan->total = 0;
        $pesanan->save();

        $total = 0;
        $produkIds = $request->input('produk_id', []);
        $qtys = $request->input('qty', []);
        $hargaSatuans = $request->input('harga_satuan', []);

        foreach ($produkIds as $index => $pid) {
            if (!$pid) continue;
            $qty = (int) ($qtys[$index] ?? 0);
            $harga = (float) ($hargaSatuans[$index] ?? 0);
            $subtotal = $qty * $harga;
            if ($qty > 0 && $harga >= 0) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->pesanan_id,
                    'produk_id' => $pid,
                    'qty' => $qty,
                    'harga_satuan' => $harga,
                    'subtotal' => $subtotal,
                ]);
                $total += $subtotal;
            }
        }

        $pesanan->total = $total;
        $pesanan->save();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function show(string $id)
    {
        $data['pesanan'] = Pesanan::with(['warga', 'details.produk'])->findOrFail($id);
        return view('admin.pesanan.show', $data);
    }

    public function edit(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string|in:baru,diproses,selesai,dibatalkan',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('admin.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        // Hapus detail pesanan terlebih dahulu jika tidak ada cascade delete di database
        $pesanan->details()->delete();
        $pesanan->delete();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
