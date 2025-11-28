@extends('layouts.dasher.app')

@section('title', 'Detail Pelanggan')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Detail Pelanggan</h1>
                <p class="text-muted mb-0">Informasi lengkap data pelanggan</p>
            </div>
            <div>
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Informasi Personal</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="40%" class="text-muted">First Name</td>
                            <td><strong>{{ $dataPelanggan->first_name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Last Name</td>
                            <td><strong>{{ $dataPelanggan->last_name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Birthday</td>
                            <td><strong>{{ $dataPelanggan->birthday ? \Carbon\Carbon::parse($dataPelanggan->birthday)->format('d M Y') : '-' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Gender</td>
                            <td><strong>{{ $dataPelanggan->gender ?? '-' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td><strong>{{ $dataPelanggan->email }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Phone</td>
                            <td><strong>{{ $dataPelanggan->phone ?? '-' }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Files</h5>
                    <a href="{{ route('admin.pelanggan.edit', $dataPelanggan) }}" class="btn btn-sm btn-primary">
                        <i class="ti ti-edit me-1"></i> Edit
                    </a>
                </div>
                <div class="card-body">
                    @if($dataPelanggan->files && count($dataPelanggan->files) > 0)
                        <div class="row g-3">
                            @foreach($dataPelanggan->files as $file)
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body p-2">
                                        @php
                                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                        @endphp
                                        @if($isImage)
                                            <img src="{{ Storage::url($file) }}" alt="File" class="img-fluid rounded mb-2" style="max-height: 200px; width: 100%; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center rounded mb-2" style="height: 200px;">
                                                <i class="ti ti-file fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-truncate" style="max-width: 150px;" title="{{ basename($file) }}">{{ basename($file) }}</small>
                                            <a href="{{ Storage::url($file) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Download">
                                                <i class="ti ti-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="ti ti-file-off fs-1 text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada files yang diupload</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.pelanggan.edit', $dataPelanggan) }}" class="btn btn-warning">
            <i class="ti ti-edit me-2"></i> Edit
        </a>
        <form action="{{ route('admin.pelanggan.destroy', $dataPelanggan) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="ti ti-trash me-2"></i> Hapus
            </button>
        </form>
    </div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

