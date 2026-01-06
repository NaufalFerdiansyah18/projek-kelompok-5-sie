@extends('layouts.dasher.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Detail Pesanan</h1>
                <p class="text-muted mb-0">Nomor: {{ $pesanan->nomor_pesanan }}</p>
            </div>
            <div>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mb-3">Informasi Pemesan</h5>
                            <p><strong>Nama:</strong> {{ $pesanan->warga->nama ?? '-' }}</p>
                            <p><strong>Alamat Kirim:</strong> {{ $pesanan->alamat_kirim ?? '-' }}</p>
                            <p><strong>RT/RW:</strong> {{ $pesanan->rt ?? '-' }}/{{ $pesanan->rw ?? '-' }}</p>
                            <p><strong>Metode Bayar:</strong> {{ $pesanan->metode_bayar ?? '-' }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="mb-3">Ringkasan Pesanan</h5>
                            <p><strong>Status:</strong>
                                <span class="badge bg-{{ $pesanan->status === 'selesai' ? 'success' : ($pesanan->status === 'dibatalkan' ? 'danger' : 'secondary') }}">
                                    {{ ucfirst($pesanan->status) }}
                                </span>
                            </p>
                            <p><strong>Total:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                            <p><strong>Dibuat:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5 class="mb-3">Item Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesanan->details as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->produk->nama_produk ?? '-' }}</td>
                                        <td>{{ $d->qty }}</td>
                                        <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada item</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
