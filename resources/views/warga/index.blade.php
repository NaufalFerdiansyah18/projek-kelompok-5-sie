@extends('layouts.dasher.app')

@section('title', 'Data Warga')

@section('content')
<div class="mb-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2">Data Warga</h1>
            <p class="text-muted mb-0">Kelola data warga</p>
        </div>
        <div>
            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-2"></i> Tambah Warga
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
        <form action="{{ route('warga.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-5 col-lg-4">
                <label class="form-label text-muted small">Cari Data Warga</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="ti ti-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, NIK, email..." value="{{ $filters['search'] ?? '' }}">
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <label class="form-label text-muted small">Filter Gender</label>
                <select name="gender" class="form-select">
                    <option value="">Semua</option>
                    <option value="Laki-laki" @selected(($filters['gender'] ?? '') === 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(($filters['gender'] ?? '') === 'Perempuan')>Perempuan</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-2 d-flex gap-2">
                <button type="submit" class="btn btn-success flex-fill">
                    <i class="ti ti-filter me-1"></i> Terapkan
                </button>
                <a href="{{ route('warga.index') }}" class="btn btn-light border flex-fill">
                    Reset
                </a>
            </div>
            @if(!empty($filters['search']))
            <div class="col-12">
                <a href="{{ route('warga.index', !empty($filters['gender']) ? ['gender' => $filters['gender']] : []) }}" class="btn btn-link px-0 text-decoration-none">
                        Bersihkan pencarian
                    </a>
                </div>
            @endif
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No KTP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Pekerjaan</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($warga as $index => $item)
                    <tr>
                        <td>{{ $warga->firstItem() + $index }}</td>
                        <td>{{ $item->no_ktp }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @if($item->jenis_kelamin)
                                <span class="badge bg-info">
                                    {{ $item->jenis_kelamin }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->agama }}</td>
                        <td>{{ $item->pekerjaan ?? '-' }}</td>
                        <td>{{ $item->telp ?? '-' }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-sm btn-warning">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus warga ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data warga</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="table-footer">
                        <td colspan="9" class="text-center py-3">
                            <div class="d-flex justify-content-between align-items-center px-3">
                                <div class="text-muted small">
                                    <i class="ti ti-info-circle me-1"></i>
                                    Total Data: <strong>{{ $warga->total() }}</strong> Warga
                                </div>
                                <div class="text-muted small">
                                    <i class="ti ti-calendar me-1"></i>
                                    Terakhir diperbarui: {{ now()->format('d M Y') }}
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @if($warga->hasPages())
    <div class="card-footer bg-white border-top d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
        <div class="text-muted small">
            Menampilkan <b>{{ $warga->firstItem() }}</b> hingga <b>{{ $warga->lastItem() }}</b> dari <b>{{ $warga->total() }}</b> data
        </div>
        <div class="pagination-wrapper mb-0">
            {{ $warga->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .table-footer {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-top: 2px solid #059669;
    }

    .table-footer td {
        color: #065f46;
        font-weight: 500;
    }

    .table thead {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border-bottom: 2px solid #059669;
    }

    .table thead th {
        color: #065f46;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        padding: 12px 16px;
    }
</style>
@endpush
