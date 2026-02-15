# Panduan Pemasangan Dasher UI Template ke Laravel

## 📋 Daftar Isi
1. [Persiapan](#persiapan)
2. [Copy Assets](#copy-assets)
3. [Membuat Layout Blade](#membuat-layout-blade)
4. [Membuat Partials](#membuat-partials)
5. [Konfigurasi Routes](#konfigurasi-routes)
6. [Update Views](#update-views)
7. [Testing](#testing)

---

## 1. Persiapan

### 1.1 Struktur Project
Pastikan project Laravel sudah siap dengan struktur:
```
NaufalFramework-master/
├── app/
├── resources/
│   └── views/
│       ├── admin/
│       └── layouts/
├── public/
└── routes/
    └── web.php
```

### 1.2 Template Dasher UI
- Download atau siapkan template Dasher UI
- Lokasi template: `c:\Users\ADVAN\Downloads\dasher-ui-1.0.0\`

---

## 2. Copy Assets

### 2.1 Copy Images dari Template
Copy folder images dari template Dasher UI ke public folder Laravel:

**Windows PowerShell:**
```powershell
# Buat folder tujuan
New-Item -ItemType Directory -Path "public\assets-dasher\images" -Force

# Copy images dari template
Copy-Item -Path "C:\Users\ADVAN\Downloads\dasher-ui-1.0.0\public\images\*" -Destination "public\assets-dasher\images\" -Recurse -Force
```

**Atau manual:**
- Copy folder `images` dari `dasher-ui-1.0.0/public/`
- Paste ke `public/assets-dasher/images/`

### 2.2 Struktur Assets yang Diperlukan
```
public/
└── assets-dasher/
    └── images/
        ├── avatar/
        ├── brand/
        └── ... (files lainnya)
```

**Catatan:** Dasher UI menggunakan CDN untuk CSS dan JS (Bootstrap, Tabler Icons, SimpleBar), jadi tidak perlu copy file CSS/JS.

---

## 3. Membuat Layout Blade

### 3.1 Buat File Layout Utama
Buat file: `resources/views/layouts/dasher/app.blade.php`

**Langkah-langkah:**
1. Buat folder `resources/views/layouts/dasher/` jika belum ada
2. Buat file `app.blade.php`
3. Struktur dasar layout:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasher UI')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- SimpleBar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.css">
    
    <!-- Custom CSS untuk Sidebar & Layout -->
    <style>
        :root {
            --dasher-sidebar-width: 280px;
            --dasher-sidebar-collapsed-width: 80px;
        }
        
        /* Sidebar Styles */
        #miniSidebar {
            width: var(--dasher-sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: #fff;
            border-right: 1px solid #e9ecef;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        
        /* Content Area */
        #content {
            margin-left: var(--dasher-sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        /* Sidebar Collapse */
        html.collapsed #miniSidebar {
            width: var(--dasher-sidebar-collapsed-width);
        }
        
        html.collapsed #miniSidebar .text,
        html.collapsed #miniSidebar .site-logo-text {
            display: none;
        }
        
        /* Mobile Responsive */
        @media (max-width: 991px) {
            #miniSidebar {
                display: none;
            }
            #content {
                margin-left: 0;
            }
        }
        
        /* Navigation Styles */
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #343a40;
            text-decoration: none;
        }
        
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background-color: #e9ecef;
            color: #007bff;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    @include('layouts.dasher.sidebar')
    
    <!-- Mobile Sidebar -->
    @include('layouts.dasher.mobile-sidebar')
    
    <!-- Content -->
    <div id="content" class="position-relative">
        <!-- Header -->
        @include('layouts.dasher.header')
        
        <!-- Main Content -->
        <div class="custom-container py-4">
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SimpleBar JS -->
    <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
    
    <!-- Custom JS untuk Sidebar Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const html = document.documentElement;
            
            // Toggle sidebar collapse
            document.querySelectorAll('.sidebar-toggle').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    html.classList.toggle('collapsed');
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
```

---

## 4. Membuat Partials

### 4.1 Sidebar (Desktop)
Buat file: `resources/views/layouts/dasher/sidebar.blade.php`

```php
<nav id="miniSidebar" class="navbar-nav">
    <div>
        <!-- Brand Logo -->
        <div class="brand-logo">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('assets-dasher/images/brand/logo/logo-icon.svg') }}" alt="Dasher" height="32">
                <span class="fw-bold fs-4 site-logo-text">Dasher</span>
            </a>
        </div>
        
        <!-- Navigation Menu -->
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-files" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.pelanggan.index') }}" class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-users" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Pelanggan</span>
                </a>
            </li>
            
            <!-- Tambahkan menu lainnya -->
        </ul>
    </div>
</nav>
```

### 4.2 Header
Buat file: `resources/views/layouts/dasher/header.blade.php`

```php
<header class="border-bottom bg-white">
    <div class="custom-container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Mobile Menu Toggle -->
            <button class="btn btn-ghost d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="ti ti-menu-2"></i>
            </button>
            
            <!-- Desktop Sidebar Toggle -->
            <button class="btn btn-ghost d-none d-lg-block sidebar-toggle">
                <i class="ti ti-menu-2"></i>
            </button>
            
            <!-- Search Bar -->
            <div class="flex-grow-1 mx-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search...">
                </div>
            </div>
            
            <!-- User Menu & Notifications -->
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-ghost position-relative">
                    <i class="ti ti-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
                </button>
                
                <div class="dropdown">
                    <button class="btn btn-ghost dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets-dasher/images/avatar/avatar-1.jpg') }}" alt="User" class="avatar rounded-circle" width="32" height="32">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
```

### 4.3 Mobile Sidebar
Buat file: `resources/views/layouts/dasher/mobile-sidebar.blade.php`

```php
<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('assets-dasher/images/brand/logo/logo-icon.svg') }}" alt="Dasher" height="32">
                <span class="fw-bold fs-4">Dasher</span>
            </a>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="navbar-nav flex-column">
            <!-- Menu items sama seperti sidebar desktop -->
        </ul>
    </div>
</div>
```

---

## 5. Konfigurasi Routes

### 5.1 Update Routes
Edit file: `routes/web.php`

```php
// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard-dasher');
    })->name('dashboard');
    
    // Pelanggan Routes
    Route::resource('pelanggan', PelangganController::class);
});
```

---

## 6. Update Views

### 6.1 Update View yang Ada
Untuk setiap view (index, create, edit), update dengan struktur:

```php
@extends('layouts.dasher.app')

@section('title', 'Nama Halaman')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Judul Halaman</h1>
                <p class="text-muted mb-0">Deskripsi halaman</p>
            </div>
            <div>
                <a href="{{ route('nama.route.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah Data
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Table atau Form -->
        </div>
    </div>
@endsection
```

### 6.2 Contoh: Update Index View
```php
@extends('layouts.dasher.app')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Data Pelanggan</h1>
                <p class="text-muted mb-0">List data seluruh pelanggan</p>
            </div>
            <div>
                <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah Pelanggan
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataPelanggan as $item)
                        <tr>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.pelanggan.edit', $item) }}" class="btn btn-sm btn-warning">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pelanggan.destroy', $item) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
```

### 6.3 Update Create/Edit Views
Struktur form:
```php
@extends('layouts.dasher.app')

@section('title', 'Tambah Data')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Tambah Data</h1>
                <p class="text-muted mb-0">Form untuk menambahkan data baru</p>
            </div>
            <div>
                <a href="{{ route('nama.route.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('nama.route.store') }}" method="POST">
                @csrf
                <!-- Form fields -->
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-2"></i> Simpan
                    </button>
                    <a href="{{ route('nama.route.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
```

---

## 7. Testing

### 7.1 Checklist Testing
- [ ] Assets images sudah ter-copy dengan benar
- [ ] Layout utama (`app.blade.php`) sudah dibuat
- [ ] Partials (sidebar, header, mobile-sidebar) sudah dibuat
- [ ] Routes sudah dikonfigurasi
- [ ] Views sudah di-update menggunakan layout Dasher UI
- [ ] Sidebar bisa collapse/expand
- [ ] Mobile sidebar berfungsi
- [ ] Navigation menu aktif state bekerja
- [ ] Form create/edit berfungsi
- [ ] Table menampilkan data dengan benar
- [ ] Alert messages berfungsi

### 7.2 Testing Manual
1. Akses `/admin/dashboard` - pastikan layout Dasher UI muncul
2. Test sidebar toggle - pastikan bisa collapse/expand
3. Test mobile view - pastikan mobile sidebar muncul
4. Test navigation - pastikan menu aktif state bekerja
5. Test CRUD operations - pastikan create, read, update, delete berfungsi

---

## 8. Tips & Best Practices

### 8.1 Icon Usage
- Gunakan Tabler Icons (`ti ti-*`)
- Contoh: `<i class="ti ti-plus"></i>`, `<i class="ti ti-edit"></i>`

### 8.2 Button Styling
- Primary: `<button class="btn btn-primary">`
- Secondary: `<button class="btn btn-outline-secondary">`
- Warning: `<button class="btn btn-sm btn-warning">`
- Danger: `<button class="btn btn-sm btn-danger">`

### 8.3 Table Styling
- Gunakan: `class="table table-hover align-middle"`
- Responsive: wrap dengan `<div class="table-responsive">`

### 8.4 Card Styling
- Gunakan: `class="card border-0 shadow-sm"`
- Body: `<div class="card-body">`

### 8.5 Spacing
- Margin bottom: `mb-6` untuk section utama
- Gap: `gap-2` untuk button groups
- Padding: `py-4` untuk container

---

## 9. Troubleshooting

### 9.1 Images Tidak Muncul
- Pastikan path assets benar: `asset('assets-dasher/images/...')`
- Pastikan folder `public/assets-dasher/images/` ada
- Clear cache: `php artisan cache:clear`

### 9.2 Sidebar Tidak Berfungsi
- Pastikan JavaScript Bootstrap sudah di-load
- Pastikan class `sidebar-toggle` ada di button
- Check console browser untuk error JavaScript

### 9.3 Layout Tidak Responsive
- Pastikan viewport meta tag ada
- Pastikan media queries CSS sudah benar
- Test di berbagai ukuran layar

### 9.4 Icons Tidak Muncul
- Pastikan Tabler Icons CDN sudah di-load
- Pastikan class icon benar: `ti ti-*`
- Check network tab untuk CDN loading

---

## 10. File Structure Final

```
resources/views/
├── layouts/
│   └── dasher/
│       ├── app.blade.php          # Layout utama
│       ├── sidebar.blade.php      # Sidebar desktop
│       ├── header.blade.php       # Header
│       └── mobile-sidebar.blade.php # Sidebar mobile
├── admin/
│   ├── dashboard-dasher.blade.php
│   ├── pelanggan/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── user/
│       ├── index.blade.php
│       ├── create.blade.php
│       └── edit.blade.php
└── products/
    ├── index.blade.php
    ├── create.blade.php
    ├── edit.blade.php
    └── show.blade.php

public/
└── assets-dasher/
    └── images/
        ├── avatar/
        ├── brand/
        └── ...

routes/
└── web.php
```

---

## 11. Kesimpulan

Dengan mengikuti langkah-langkah di atas, Dasher UI template sudah berhasil diintegrasikan ke dalam project Laravel. Semua halaman admin sekarang menggunakan layout Dasher UI yang modern dan responsive.

**Key Points:**
- ✅ Menggunakan CDN untuk CSS/JS (Bootstrap, Tabler Icons, SimpleBar)
- ✅ Hanya copy images dari template
- ✅ Layout modular dengan partials
- ✅ Responsive design (desktop & mobile)
- ✅ Konsisten styling di semua halaman
- ✅ Easy to maintain dan extend

---

**Selamat! Dasher UI sudah terpasang dengan sukses! 🎉**

