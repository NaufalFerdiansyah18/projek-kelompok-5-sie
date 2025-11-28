@extends('layouts.dasher.app')

@section('title', 'Edit Pelanggan')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Edit Pelanggan</h1>
                <p class="text-muted mb-0">Form untuk mengubah data pelanggan</p>
            </div>
            <div>
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pelanggan.update', $dataPelanggan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $dataPelanggan->first_name) }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $dataPelanggan->last_name) }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Birthday -->
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input name="birthday" type="date" id="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{ old('birthday', $dataPelanggan->birthday) }}">
                            @error('birthday')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <!-- Gender -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            @php
                                $selectedGender = old('gender', $dataPelanggan->gender);
                            @endphp
                            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" @selected(in_array($selectedGender, ['Laki-laki', 'Male']))>Laki-laki</option>
                                <option value="Perempuan" @selected(in_array($selectedGender, ['Perempuan', 'Female']))>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $dataPelanggan->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input name="phone" type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $dataPelanggan->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Files -->
                        <div class="mb-3">
                            <label for="files" class="form-label">Tambah Files</label>
                            <input name="files[]" type="file" id="files" class="form-control @error('files.*') is-invalid @enderror" multiple accept="image/*,.pdf,.doc,.docx">
                            <small class="form-text text-muted">Pilih multiple files untuk ditambahkan (Gambar, PDF, DOC, DOCX). Maksimal 5MB per file</small>
                            @error('files.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Existing Files -->
                @if($dataPelanggan->files && count($dataPelanggan->files) > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <label class="form-label">Files yang Sudah Diupload</label>
                        <div class="row g-3">
                            @foreach($dataPelanggan->files as $index => $file)
                            <div class="col-md-3">
                                <div class="card border">
                                    <div class="card-body p-2">
                                        @php
                                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                        @endphp
                                        @if($isImage)
                                            <img src="{{ Storage::url($file) }}" alt="File" class="img-fluid rounded mb-2" style="max-height: 150px; width: 100%; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center rounded mb-2" style="height: 150px;">
                                                <i class="ti ti-file fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-truncate" style="max-width: 120px;">{{ basename($file) }}</small>
                                            <a href="{{ Storage::url($file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-2"></i> Update
                    </button>
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
