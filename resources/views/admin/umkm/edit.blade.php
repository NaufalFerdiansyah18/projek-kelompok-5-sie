<!--

=========================================================
* Volt Pro - Premium Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)
* License (https://themesberg.com/licensing)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.

-->
@extends('layouts.dasher.app')

@section('title', 'Edit UMKM')

{{-- start css --}}
@section('css')
    @include('layouts.admin.css')
@endsection
{{-- end css --}}

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
            <li class="breadcrumb-item"><a href="{{ route('umkm.index') }}">UMKM</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit UMKM</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit UMKM</h1>
            <p class="mb-0">Form untuk mengedit data UMKM.</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow">
    <div class="card-body">
                <form action="{{ route('umkm.update', $dataUmkm->umkm_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nama Usaha -->
                            <div class="mb-3">
                                <label for="nama_usaha" class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                                <input name="nama_usaha" id="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" value="{{ old('nama_usaha', $dataUmkm->nama_usaha) }}" required>
                                @error('nama_usaha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pemilik Warga ID -->
                            <div class="mb-3">
                                <label for="pemilik_warga_id" class="form-label">ID Pemilik Warga <span class="text-danger">*</span></label>
                                <input name="pemilik_warga_id" type="number" id="pemilik_warga_id" class="form-control @error('pemilik_warga_id') is-invalid @enderror" value="{{ old('pemilik_warga_id', $dataUmkm->pemilik_warga_id) }}" required>
                                @error('pemilik_warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $dataUmkm->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- RT -->
                            <div class="mb-3">
                                <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                <input name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt', $dataUmkm->rt) }}" required>
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <!-- RW -->
                            <div class="mb-3">
                                <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                <input name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw', $dataUmkm->rw) }}" required>
                                @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Mikro" {{ old('kategori', $dataUmkm->kategori) == 'Mikro' ? 'selected' : '' }}>Mikro</option>
                                    <option value="Kecil" {{ old('kategori', $dataUmkm->kategori) == 'Kecil' ? 'selected' : '' }}>Kecil</option>
                                    <option value="Menengah" {{ old('kategori', $dataUmkm->kategori) == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kontak -->
                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                <input name="kontak" id="kontak" class="form-control @error('kontak') is-invalid @enderror" value="{{ old('kontak', $dataUmkm->kontak) }}" required>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $dataUmkm->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo/Foto Usaha -->
                            <div class="mb-3">
                                <label for="logo_foto_usaha" class="form-label">Logo/Foto Usaha</label>
                                @if($dataUmkm->logo_foto_usaha)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $dataUmkm->logo_foto_usaha) }}" alt="Current Logo" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                        <p class="text-muted small">Foto saat ini</p>
                                    </div>
                                @endif
                                <input name="logo_foto_usaha" type="file" id="logo_foto_usaha" class="form-control @error('logo_foto_usaha') is-invalid @enderror" accept="image/*">
                                <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                                @error('logo_foto_usaha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('umkm.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
</div>

@endsection
    <script src="{{ asset('assets-admin/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('assets-admin/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('assets-admin/vendor/nouislider/distribute/nouislider.min.js') }}"></script>

    <!-- Jarallax -->
    <script src="{{ asset('assets-admin/vendor/jarallax/dist/jarallax.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('assets-admin/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Count up -->
    <script src="{{ asset('assets-admin/vendor/countup.js/dist/countUp.umd.js') }}"></script>

    <!-- Notyf -->
    <script src="{{ asset('assets-admin/vendor/notyf/notyf.min.js') }}"></script>

    <!-- Charts -->
    <script src="{{ asset('assets-admin/vendor/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('assets-admin/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('assets-admin/vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('assets-admin/js/volt.js') }}"></script>
    <!-- END: JS -->

