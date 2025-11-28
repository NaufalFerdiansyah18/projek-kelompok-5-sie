@extends('layouts.dasher.app')

@section('title', 'Data UMKM')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Data UMKM</h1>
                <p class="text-muted mb-0">Kelola data Usaha Mikro, Kecil, dan Menengah</p>
            </div>
            <div>
                <a href="{{ route('umkm.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah UMKM
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
            <form action="{{ route('umkm.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Cari Nama Usaha / Alamat</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="{{ $filters['search'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua</option>
                        @foreach($categories ?? [] as $kategori)
                            <option value="{{ $kategori }}" @selected(($filters['kategori'] ?? '') === $kategori)>{{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-fill">
                        <i class="ti ti-filter me-1"></i> Terapkan
                    </button>
                    <a href="{{ route('umkm.index') }}" class="btn btn-light border flex-fill">
                        Reset
                    </a>
                </div>
                @if(!empty($filters['search']))
                    <div class="col-12">
                        <a href="{{ route('umkm.index', !empty($filters['kategori']) ? ['kategori' => $filters['kategori']] : []) }}" class="btn btn-link px-0 text-decoration-none">
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
                            <th>Logo/Foto</th>
                            <th>Nama Usaha</th>
                            <th>Pemilik ID</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>Kategori</th>
                            <th>Kontak</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataUmkm as $item)
                        <tr>
                            <td>
                                @if($item->logo_foto_usaha)
                                    <img src="{{ asset('storage/' . $item->logo_foto_usaha) }}" alt="Logo" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="ti ti-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->nama_usaha }}</td>
                            <td>{{ $item->pemilik_warga_id }}</td>
                            <td>{{ Str::limit($item->alamat, 30) }}</td>
                            <td>{{ $item->rt }}/{{ $item->rw }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('umkm.edit', $item->umkm_id) }}" class="btn btn-sm btn-warning">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('umkm.destroy', $item->umkm_id) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?')">
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
                            <td colspan="8" class="text-center">Tidak ada data UMKM</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="table-footer">
                            <td colspan="8" class="text-center py-3">
                                <div class="d-flex justify-content-between align-items-center px-3">
                                    <div class="text-muted small">
                                        <i class="ti ti-info-circle me-1"></i>
                                        Total Data: <strong>{{ $dataUmkm->total() }}</strong> UMKM
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
        @if($dataUmkm->hasPages())
        <div class="card-footer bg-white border-top d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="text-muted small">
                Menampilkan <b>{{ $dataUmkm->firstItem() }}</b> hingga <b>{{ $dataUmkm->lastItem() }}</b> dari <b>{{ $dataUmkm->total() }}</b> data
            </div>
            <div class="pagination-wrapper mb-0">
                {{ $dataUmkm->onEachSide(1)->links('pagination::bootstrap-5') }}
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
