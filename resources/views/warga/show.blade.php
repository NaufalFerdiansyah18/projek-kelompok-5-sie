@extends('layouts.dasher.app')

@section('title', 'Detail Warga')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Warga</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Warga</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Warga</h1>
                <p class="mb-0">Informasi lengkap tentang warga</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">No KTP</h6>
                            <p class="fw-bold">{{ $warga->no_ktp }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Nama</h6>
                            <p class="fw-bold">{{ $warga->nama }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Jenis Kelamin</h6>
                            <p class="fw-bold">{{ $warga->jenis_kelamin }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Agama</h6>
                            <p class="fw-bold">{{ $warga->agama }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Pekerjaan</h6>
                            <p class="fw-bold">{{ $warga->pekerjaan ?? '-' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Telepon</h6>
                            <p class="fw-bold">{{ $warga->telp ?? '-' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Email</h6>
                            <p class="fw-bold">{{ $warga->email ?? '-' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Tanggal Dibuat</h6>
                            <p class="fw-bold">{{ $warga->created_at->format('d M Y H:i') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Terakhir Diperbarui</h6>
                            <p class="fw-bold">{{ $warga->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
