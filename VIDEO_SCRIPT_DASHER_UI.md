# 🎬 Script Video: Pemasangan Dasher UI Template ke Laravel

## Intro (30 detik)
"Selamat datang di tutorial pemasangan Dasher UI Template ke project Laravel. Dalam video ini, kita akan belajar cara mengintegrasikan template Dasher UI yang modern dan responsive ke dalam project Laravel kita step by step."

---

## STEP 1: Persiapan Template (1 menit)

### Narasi:
"Langkah pertama, kita perlu menyiapkan template Dasher UI. Template ini bisa didownload dari ThemeWagon atau sumber lainnya."

### Aksi di Video:
1. Tunjukkan lokasi template Dasher UI di folder Downloads
2. Tunjukkan struktur folder template (public/images, dll)
3. Tunjukkan project Laravel yang akan digunakan

### Key Points:
- ✅ Template Dasher UI sudah siap
- ✅ Project Laravel sudah ada
- ✅ Struktur folder sudah dipahami

---

## STEP 2: Copy Assets Images (2 menit)

### Narasi:
"Langkah kedua, kita perlu copy assets images dari template ke folder public Laravel. Kita hanya perlu copy images karena CSS dan JS akan menggunakan CDN."

### Aksi di Video:
1. Buka PowerShell/Command Prompt
2. Buat folder `public/assets-dasher/images`
3. Copy images dari template ke Laravel:

```powershell
# Buat folder
New-Item -ItemType Directory -Path "public\assets-dasher\images" -Force

# Copy images
Copy-Item -Path "C:\Users\ADVAN\Downloads\dasher-ui-1.0.0\public\images\*" -Destination "public\assets-dasher\images\" -Recurse -Force
```

4. Verify bahwa images sudah ter-copy dengan benar
5. Tunjukkan struktur folder yang sudah dibuat

### Key Points:
- ✅ Hanya copy images, bukan CSS/JS
- ✅ Folder structure: `public/assets-dasher/images/`
- ✅ Verify semua images sudah ter-copy

---

## STEP 3: Membuat Layout Utama (3 menit)

### Narasi:
"Langkah ketiga, kita akan membuat layout utama Dasher UI menggunakan Blade template. Layout ini akan menjadi base untuk semua halaman admin."

### Aksi di Video:
1. Buat folder `resources/views/layouts/dasher/`
2. Buat file `app.blade.php`
3. Tulis struktur HTML dasar:
   - DOCTYPE, head, meta tags
   - CDN links (Bootstrap, Tabler Icons, SimpleBar)
   - Custom CSS untuk sidebar
4. Tulis struktur body:
   - Include sidebar
   - Include header
   - Content area dengan `@yield('content')`
5. Tulis JavaScript untuk sidebar toggle
6. Save file

### Key Points:
- ✅ Layout menggunakan Blade `@extends` dan `@yield`
- ✅ CDN untuk CSS/JS (Bootstrap, Tabler Icons, SimpleBar)
- ✅ Custom CSS untuk sidebar styling
- ✅ JavaScript untuk sidebar toggle functionality

### Code Highlights:
```php
<!-- CDN Links -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<!-- Custom CSS -->
<style>
    #miniSidebar {
        width: 280px;
        position: fixed;
        /* ... */
    }
</style>
```

---

## STEP 4: Membuat Sidebar (Desktop) (2 menit)

### Narasi:
"Langkah keempat, kita akan membuat sidebar untuk desktop. Sidebar ini berisi navigation menu dan logo."

### Aksi di Video:
1. Buat file `resources/views/layouts/dasher/sidebar.blade.php`
2. Tulis struktur sidebar:
   - Brand logo dengan image
   - Navigation menu (Dashboard, Pelanggan, UMKM, User, Products)
   - Active state dengan `request()->routeIs()`
3. Gunakan Tabler Icons untuk menu items
4. Styling dengan CSS classes
5. Save file

### Key Points:
- ✅ Brand logo menggunakan asset helper
- ✅ Navigation menu dengan active state
- ✅ Tabler Icons untuk icons
- ✅ Responsive dengan collapse functionality

### Code Highlights:
```php
<nav id="miniSidebar" class="navbar-nav">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets-dasher/images/brand/logo/logo-icon.svg') }}" alt="Dasher">
            <span>Dasher</span>
        </a>
    </div>
    
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ti ti-files"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- More menu items -->
    </ul>
</nav>
```

---

## STEP 5: Membuat Header (1.5 menit)

### Narasi:
"Langkah kelima, kita akan membuat header yang berisi search bar, notifications, dan user menu."

### Aksi di Video:
1. Buat file `resources/views/layouts/dasher/header.blade.php`
2. Tulis struktur header:
   - Mobile menu toggle button
   - Desktop sidebar toggle button
   - Search bar
   - Notification bell
   - User dropdown menu
3. Styling dengan Bootstrap classes
4. Save file

### Key Points:
- ✅ Mobile dan desktop toggle buttons
- ✅ Search bar dengan icon
- ✅ Notification badge
- ✅ User dropdown menu

### Code Highlights:
```php
<header class="border-bottom bg-white">
    <div class="custom-container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Toggle buttons -->
            <button class="btn btn-ghost d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="ti ti-menu-2"></i>
            </button>
            
            <!-- Search bar -->
            <div class="input-group">
                <span class="input-group-text"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            
            <!-- User menu -->
            <div class="dropdown">
                <button class="btn btn-ghost dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets-dasher/images/avatar/avatar-1.jpg') }}" class="avatar">
                </button>
                <!-- Dropdown menu -->
            </div>
        </div>
    </div>
</header>
```

---

## STEP 6: Membuat Mobile Sidebar (1.5 menit)

### Narasi:
"Langkah keenam, kita akan membuat mobile sidebar menggunakan Bootstrap Offcanvas untuk tampilan mobile."

### Aksi di Video:
1. Buat file `resources/views/layouts/dasher/mobile-sidebar.blade.php`
2. Tulis struktur offcanvas:
   - Offcanvas header dengan logo
   - Offcanvas body dengan navigation menu
   - Close button
3. Menu items sama seperti desktop sidebar
4. Save file

### Key Points:
- ✅ Bootstrap Offcanvas component
- ✅ Menu items sama seperti desktop
- ✅ Responsive untuk mobile devices

### Code Highlights:
```php
<div class="offcanvas offcanvas-start d-lg-none" id="offcanvasSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">
            <img src="{{ asset('assets-dasher/images/brand/logo/logo-icon.svg') }}" alt="Dasher">
            <span>Dasher</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Navigation menu -->
    </div>
</div>
```

---

## STEP 7: Update Routes (1 menit)

### Narasi:
"Langkah ketujuh, kita perlu update routes untuk menggunakan layout Dasher UI."

### Aksi di Video:
1. Buka file `routes/web.php`
2. Update admin routes:
   - Group routes dengan prefix `admin`
   - Update dashboard route
   - Update resource routes (pelanggan, user, dll)
3. Save file

### Key Points:
- ✅ Routes menggunakan prefix `admin`
- ✅ Route names menggunakan `admin.*`
- ✅ Resource routes untuk CRUD operations

### Code Highlights:
```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard-dasher');
    })->name('dashboard');
    
    Route::resource('pelanggan', PelangganController::class);
});
```

---

## STEP 8: Update Views - Index Page (2 menit)

### Narasi:
"Langkah kedelapan, kita akan update views yang ada untuk menggunakan layout Dasher UI. Kita mulai dengan index page."

### Aksi di Video:
1. Buka file `resources/views/admin/pelanggan/index.blade.php`
2. Update dengan struktur Dasher UI:
   - `@extends('layouts.dasher.app')`
   - `@section('title')`
   - `@section('content')` dengan struktur:
     - Header section dengan title dan button
     - Success message alert
     - Card dengan table
3. Update table:
   - Gunakan Tabler Icons untuk action buttons
   - Styling dengan Bootstrap classes
   - Responsive table
4. Save file

### Key Points:
- ✅ Extend layout Dasher UI
- ✅ Struktur konsisten dengan header dan card
- ✅ Tabler Icons untuk buttons
- ✅ Responsive table

### Code Highlights:
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

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <!-- Table content -->
                </table>
            </div>
        </div>
    </div>
@endsection
```

---

## STEP 9: Update Views - Create/Edit Pages (2 menit)

### Narasi:
"Langkah kesembilan, kita akan update create dan edit pages untuk menggunakan layout Dasher UI."

### Aksi di Video:
1. Buka file `resources/views/admin/pelanggan/create.blade.php`
2. Update dengan struktur Dasher UI:
   - `@extends('layouts.dasher.app')`
   - Header section dengan title dan back button
   - Card dengan form
   - Form buttons dengan icons
3. Update `edit.blade.php` dengan struktur yang sama
4. Save files

### Key Points:
- ✅ Struktur konsisten dengan index page
- ✅ Form dengan validation error display
- ✅ Buttons dengan Tabler Icons
- ✅ Back button untuk navigasi

### Code Highlights:
```php
@extends('layouts.dasher.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Tambah Pelanggan</h1>
                <p class="text-muted mb-0">Form untuk menambahkan data pelanggan baru</p>
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
            <form action="{{ route('admin.pelanggan.store') }}" method="POST">
                @csrf
                <!-- Form fields -->
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-2"></i> Simpan
                    </button>
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
```

---

## STEP 10: Testing & Verification (2 menit)

### Narasi:
"Langkah terakhir, kita akan test aplikasi untuk memastikan semua berfungsi dengan baik."

### Aksi di Video:
1. Start Laravel server: `php artisan serve`
2. Buka browser dan akses `/admin/dashboard`
3. Test fitur-fitur:
   - ✅ Layout Dasher UI muncul
   - ✅ Sidebar bisa collapse/expand
   - ✅ Navigation menu berfungsi
   - ✅ Mobile sidebar muncul di mobile view
   - ✅ CRUD operations berfungsi
   - ✅ Alert messages muncul
   - ✅ Icons dan images muncul dengan benar
4. Test di berbagai ukuran layar (desktop, tablet, mobile)
5. Verify semua halaman menggunakan layout Dasher UI

### Key Points:
- ✅ Server berjalan dengan baik
- ✅ Layout Dasher UI muncul dengan benar
- ✅ Semua fitur berfungsi
- ✅ Responsive di semua device
- ✅ Tidak ada error di console

---

## Conclusion (30 detik)

### Narasi:
"Selamat! Dasher UI Template sudah berhasil terpasang di project Laravel kita. Semua halaman admin sekarang menggunakan layout Dasher UI yang modern dan responsive. 

Key takeaways:
1. ✅ Hanya perlu copy images, CSS/JS menggunakan CDN
2. ✅ Layout modular dengan partials (sidebar, header, mobile-sidebar)
3. ✅ Konsisten styling di semua halaman
4. ✅ Responsive design untuk desktop dan mobile
5. ✅ Easy to maintain dan extend

Jika ada pertanyaan, silakan tulis di komentar. Jangan lupa like dan subscribe untuk tutorial Laravel lainnya. Terima kasih!"

---

## Tips untuk Video:

### 1. Screen Recording:
- Gunakan screen recorder yang jelas (OBS, Camtasia, dll)
- Pastikan code editor terlihat jelas
- Zoom in untuk code yang penting
- Highlight code yang sedang dijelaskan

### 2. Narasi:
- Bicara dengan jelas dan tidak terlalu cepat
- Pause sejenak saat menulis code
- Jelaskan setiap step dengan detail
- Gunakan pointer untuk highlight area penting

### 3. Editing:
- Tambahkan text overlay untuk step numbers
- Highlight code sections yang penting
- Tambahkan transitions yang smooth
- Tambahkan background music (optional)

### 4. Thumbnail:
- Screenshot dari Dasher UI dashboard
- Text: "Install Dasher UI di Laravel - Step by Step"
- Bright colors untuk menarik perhatian

### 5. Timeline Estimasi:
- Intro: 30 detik
- Step 1: 1 menit
- Step 2: 2 menit
- Step 3: 3 menit
- Step 4: 2 menit
- Step 5: 1.5 menit
- Step 6: 1.5 menit
- Step 7: 1 menit
- Step 8: 2 menit
- Step 9: 2 menit
- Step 10: 2 menit
- Conclusion: 30 detik
- **Total: ~19 menit**

---

## Checklist sebelum Recording:

- [ ] Template Dasher UI sudah siap
- [ ] Project Laravel sudah siap
- [ ] Code editor sudah terbuka
- [ ] Terminal/PowerShell sudah siap
- [ ] Browser sudah siap untuk testing
- [ ] Screen recorder sudah siap
- [ ] Microphone sudah tested
- [ ] Script sudah dipelajari
- [ ] Environment sudah bersih (tidak ada error)

---

**Selamat membuat video! 🎥🎬**

