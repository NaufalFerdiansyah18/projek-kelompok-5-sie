@extends('layouts.dasher.app')

@section('title', 'Detail Produk')

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
                <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Produk</h1>
                <p class="mb-0">Informasi lengkap mengenai produk</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-6 col-sm-12">
                            <h5 class="mb-3">Informasi Produk</h5>
                            <p><strong>Nama Produk:</strong> {{ $produk->nama_produk }}</p>
                            <p><strong>UMKM:</strong> {{ $produk->umkm->nama_usaha ?? '-' }}</p>
                            <p><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge bg-{{ $produk->status === 'aktif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($produk->status) }}
                                </span>
                            </p>
                            <p><strong>Deskripsi:</strong><br>
                                {{ $produk->deskripsi ?? '-' }}
                            </p>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <h5 class="mb-3">Foto Produk</h5>
                            @if($produk->media && $produk->media->count() > 0)
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($produk->media as $m)
                                        <img src="{{ asset('storage/' . $m->file_path) }}"
                                             alt="{{ $produk->nama_produk }}"
                                             class="img-fluid rounded shadow-sm"
                                             style="max-width: 200px;">
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Tidak ada foto produk.</p>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('produk.edit', $produk) }}" class="btn btn-primary ms-2">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
