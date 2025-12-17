@extends('layouts.dasher.app')

@section('title', 'Tambah Ulasan')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Tambah Ulasan Produk</h1>
                <p class="text-muted mb-0">Berikan penilaian dan komentar untuk produk</p>
            </div>
            <div>
                <a href="{{ route('admin.ulasan.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.ulasan.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Produk <span class="text-danger">*</span></label>
                            <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($produk as $p)
                                    <option value="{{ $p->produk_id }}">{{ $p->nama_produk }}</option>
                                @endforeach
                            </select>
                            @error('produk_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Warga <span class="text-danger">*</span></label>
                            <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach($warga as $w)
                                    <option value="{{ $w->warga_id }}">{{ $w->nama }}</option>
                                @endforeach
                            </select>
                            @error('warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                @for($i=1;$i<=5;$i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea name="komentar" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Simpan Ulasan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
