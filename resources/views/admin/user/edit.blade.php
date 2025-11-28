@extends('layouts.dasher.app')

@section('title', 'Edit User')

@push('styles')
<style>
    .img-thumbnail {
        border: 2px solid #dee2e6;
        border-radius: 8px;
    }
</style>
@endpush

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Edit User</h1>
                <p class="text-muted mb-0">Form untuk mengubah data user</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Foto Profil</label>
                            @if($dataUser->profile_picture)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($dataUser->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            @endif
                            <input name="profile_picture" type="file" id="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</small>
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $dataUser->first_name) }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $dataUser->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input name="password_confirmation" type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-2"></i> Update
                    </button>
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
