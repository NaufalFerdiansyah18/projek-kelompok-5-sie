@extends('layouts.dasher.app')

@section('title', 'Ulasan Produk')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Ulasan Produk</h1>
                <p class="text-muted mb-0">Kelola ulasan produk dari warga</p>
            </div>
            <div>
                <a href="{{ route('admin.ulasan.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah Ulasan
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
            <form action="{{ route('admin.ulasan.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Cari Komentar</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Cari komentar">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-muted small">Rating</label>
                    <select name="rating" class="form-select">
                        <option value="">Semua</option>
                        @for($i=1;$i<=5;$i++)
                            <option value="{{ $i }}" {{ ($filters['rating'] ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
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
                        <th>Produk</th>
                        <th>Warga</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataUlasan as $u)
                        <tr>
                            <td>{{ $loop->iteration + ($dataUlasan->currentPage()-1)*$dataUlasan->perPage() }}</td>
                            <td>{{ $u->produk->nama_produk ?? '-' }}</td>
                            <td>{{ $u->warga->nama ?? '-' }}</td>
                            <td>
                                <span class="badge bg-success">{{ $u->rating }}</span>
                            </td>
                            <td>{{ Str::limit($u->komentar, 80) }}</td>
                            <td>{{ $u->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada ulasan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($dataUlasan->hasPages())
        <div class="card-footer bg-white border-top d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="text-muted small">
                <i class="ti ti-info-circle me-1"></i>
                Total Data: <strong>{{ $dataUlasan->total() }}</strong> ulasan
            </div>
            <div>
                {{ $dataUlasan->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection
