@extends('layouts.dasher.app')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Data Pelanggan</h1>
                <p class="text-muted mb-0">List data seluruh pelanggan</p>
            </div>
            <div>
                <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah Pelanggan
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
            <form action="{{ route('admin.pelanggan.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5 col-lg-4">
                    <label class="form-label text-muted small">Cari Pelanggan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Nama, email atau telepon" value="{{ $filters['search'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <label class="form-label text-muted small">Gender</label>
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
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-light border flex-fill">
                        Reset
                    </a>
                </div>
                @if(!empty($filters['search']))
                <div class="col-12">
                    <a href="{{ route('admin.pelanggan.index', !empty($filters['gender']) ? ['gender' => $filters['gender']] : []) }}" class="btn btn-link px-0 text-decoration-none">
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataPelanggan as $item)
                        <tr>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->birthday ? \Carbon\Carbon::parse($item->birthday)->format('d/m/Y') : '-' }}</td>
                            <td>
                                @if($item->gender)
                                    @php($genderLabel = $item->gender === 'Male' ? 'Laki-laki' : ($item->gender === 'Female' ? 'Perempuan' : $item->gender))
                                    <span class="badge bg-info">{{ $genderLabel }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.pelanggan.show', $item) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pelanggan.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pelanggan.destroy', $item) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pelanggan</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="table-footer">
                            <td colspan="7" class="text-center py-3">
                                <div class="d-flex justify-content-between align-items-center px-3">
                                    <div class="text-muted small">
                                        <i class="ti ti-info-circle me-1"></i>
                                        Total Data: <strong>{{ $dataPelanggan->total() }}</strong> Pelanggan
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
        @if($dataPelanggan->hasPages())
        <div class="card-footer bg-white border-top d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="text-muted small">
                Menampilkan <b>{{ $dataPelanggan->firstItem() }}</b> hingga <b>{{ $dataPelanggan->lastItem() }}</b> dari <b>{{ $dataPelanggan->total() }}</b> data
            </div>
            <div class="pagination-wrapper mb-0">
                {{ $dataPelanggan->onEachSide(1)->links('pagination::bootstrap-5') }}
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
