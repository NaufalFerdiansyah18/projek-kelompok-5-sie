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

<div class="card border-0 shadow-sm">
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
                        <td>{{ $item->jenis_kelamin }}</td>
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

        @if($warga->hasPages())
        <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between">
            <div class="text-muted small">
                Showing <b>{{ $warga->firstItem() }}</b> to <b>{{ $warga->lastItem() }}</b> of <b>{{ $warga->total() }}</b> entries
            </div>
            <div>
                {{ $warga->links() }}
            </div>
        </div>
        @endif
    </div>
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
