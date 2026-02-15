@extends('layouts.dasher.app')

@section('title', 'Detail Product')

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
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Product</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Product</h1>
                <p class="mb-0">Informasi detail produk</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-6 col-sm-12">
                            <h5 class="mb-3">Informasi Product</h5>
                            <p><strong>Name:</strong> {{ $product->name }}</p>
                            <p><strong>Price:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p><strong>Description:</strong> {{ $product->description ?? '-' }}</p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <h5 class="mb-3">Image</h5>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-width: 300px;">
                            @else
                                <p class="text-muted">No image</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary ms-2">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
