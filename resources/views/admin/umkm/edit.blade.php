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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Volt - Free Bootstrap 5 Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta name="author" content="Themesberg">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets-admin/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-admin/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets-admin/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets-admin/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets-admin/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('assets-admin/css/volt.css') }}" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="{{ route('admin.dashboard') }}">
            <img class="navbar-brand-dark" src="{{ asset('assets-admin/img/brand/light.svg') }}" alt="Volt logo" /> 
            <img class="navbar-brand-light" src="{{ asset('assets-admin/img/brand/dark.svg') }}" alt="Volt logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img src="{{ asset('assets-admin/img/team/profile-picture-3.jpg') }}" class="card-img-top rounded-circle border-white" alt="Admin User">
                    </div>
                    <div class="d-block">
                        <h2 class="h5 mb-3">Hi, Admin</h2>
                        <a href="#" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Sign Out
                        </a>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('assets-admin/img/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">Volt Overview</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pelanggan.index') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Pelanggan</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('umkm.index') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">UMKM</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content">
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                        <!-- Search form -->
                        <form class="navbar-search form-inline" id="navbar-search-main">
                            <div class="input-group input-group-merge search-bar">
                                <span class="input-group-text" id="topbar-addon">
                                    <svg class="icon icon-xs" x-description="Heroicon name: solid/search" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
                            </div>
                        </form>
                        <!-- / Search form -->
                    </div>
                </div>
            </div>
        </nav>

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

        @include('admin.partials.footer')
    </main>

    <!-- Core -->
    <script src="{{ asset('assets-admin/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
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

</body>

</html>
