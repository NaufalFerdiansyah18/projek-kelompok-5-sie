@extends('layouts.dasher.app')

@section('title', 'Data Pesanan')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Data Pesanan</h1>
                <p class="text-muted mb-0">Kelola pesanan pelanggan untuk UMKM</p>
            </div>
            <div>
                <a href="{{ route('admin.pesanan.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah Pesanan
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php($filters = $filters ?? [])
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <form action="{{ route('admin.pesanan.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Cari Nomor / Status</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Cari nomor pesanan atau status">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-muted small">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        @foreach(['baru','diproses','selesai','dibatalkan'] as $st)
                            <option value="{{ $st }}" {{ ($filters['status'] ?? '') === $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100" type="submit">
                        <i class="ti ti-filter me-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Pesanan</th>
                        <th>Nama Warga</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataPesanan as $p)
                        <tr>
                            <td>{{ $loop->iteration + ($dataPesanan->currentPage()-1)*$dataPesanan->perPage() }}</td>
                            <td class="fw-semibold">{{ $p->nomor_pesanan }}</td>
                            <td>{{ $p->warga->nama ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $p->status === 'selesai' ? 'success' : ($p->status === 'dibatalkan' ? 'danger' : 'secondary') }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                            <td>{{ $p->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.pesanan.show', $p->pesanan_id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($dataPesanan->hasPages())
        <div class="card-footer bg-white border-top d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="text-muted small">
                <i class="ti ti-info-circle me-1"></i>
                Total Data: <strong>{{ $dataPesanan->total() }}</strong> pesanan
            </div>
            <div>
                {{ $dataPesanan->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection
