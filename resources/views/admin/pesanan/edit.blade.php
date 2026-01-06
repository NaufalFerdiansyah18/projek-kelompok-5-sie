@extends('layouts.dasher.app')

@section('title', 'Edit Status Pesanan')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pesanan.index') }}">Data Pesanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Status</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Status Pesanan</h1>
                <p class="mb-0">Ubah status pesanan.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow components-section">
        <div class="card-body">
            <form action="{{ route('admin.pesanan.update', $pesanan->pesanan_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Nomor Pesanan</label>
                            <input type="text" class="form-control" value="{{ $pesanan->nomor_pesanan }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Warga</label>
                            <input type="text" class="form-control" value="{{ $pesanan->warga->nama ?? '-' }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Pesanan</label>
                            <input type="text" class="form-control" value="Rp {{ number_format($pesanan->total, 0, ',', '.') }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pesanan <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="baru" {{ old('status', $pesanan->status) == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="diproses" {{ old('status', $pesanan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ old('status', $pesanan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ old('status', $pesanan->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
