# 📝 Quick Reference: Dasher UI Installation

## 🚀 Quick Steps Overview

### 1. Copy Assets
```powershell
New-Item -ItemType Directory -Path "public\assets-dasher\images" -Force
Copy-Item -Path "C:\Users\ADVAN\Downloads\dasher-ui-1.0.0\public\images\*" -Destination "public\assets-dasher\images\" -Recurse -Force
```

### 2. File Structure
```
resources/views/layouts/dasher/
├── app.blade.php
├── sidebar.blade.php
├── header.blade.php
└── mobile-sidebar.blade.php
```

### 3. CDN Links (di app.blade.php)
```html
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tabler Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<!-- SimpleBar CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.css">

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SimpleBar JS -->
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
```

### 4. Routes Structure
```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard-dasher');
    })->name('dashboard');
    
    Route::resource('pelanggan', PelangganController::class);
});
```

### 5. View Structure (Index)
```php
@extends('layouts.dasher.app')

@section('title', 'Page Title')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Page Title</h1>
                <p class="text-muted mb-0">Description</p>
            </div>
            <div>
                <a href="{{ route('route.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah Data
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Content -->
        </div>
    </div>
@endsection
```

### 6. View Structure (Create/Edit)
```php
@extends('layouts.dasher.app')

@section('title', 'Tambah Data')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Tambah Data</h1>
                <p class="text-muted mb-0">Description</p>
            </div>
            <div>
                <a href="{{ route('route.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('route.store') }}" method="POST">
                @csrf
                <!-- Form fields -->
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-2"></i> Simpan
                    </button>
                    <a href="{{ route('route.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
```

---

## 🎨 Common Tabler Icons

```html
<!-- Navigation -->
<i class="ti ti-files"></i>        <!-- Dashboard -->
<i class="ti ti-users"></i>        <!-- Users/Pelanggan -->
<i class="ti ti-building-store"></i> <!-- UMKM -->
<i class="ti ti-user"></i>         <!-- User -->
<i class="ti ti-shopping-bag"></i> <!-- Products -->

<!-- Actions -->
<i class="ti ti-plus"></i>         <!-- Add -->
<i class="ti ti-edit"></i>         <!-- Edit -->
<i class="ti ti-trash"></i>        <!-- Delete -->
<i class="ti ti-check"></i>        <!-- Save -->
<i class="ti ti-arrow-left"></i>   <!-- Back -->
<i class="ti ti-menu-2"></i>       <!-- Menu -->
<i class="ti ti-search"></i>       <!-- Search -->
<i class="ti ti-bell"></i>         <!-- Notification -->
```

---

## 🎯 Common Bootstrap Classes

### Buttons
```html
<button class="btn btn-primary">Primary</button>
<button class="btn btn-outline-secondary">Secondary</button>
<button class="btn btn-sm btn-warning">Warning</button>
<button class="btn btn-sm btn-danger">Danger</button>
<button class="btn btn-ghost">Ghost</button>
```

### Cards
```html
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <!-- Content -->
    </div>
</div>
```

### Tables
```html
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Column</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows -->
        </tbody>
    </table>
</div>
```

### Alerts
```html
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
```

---

## 🔧 Common Laravel Helpers

### Routes
```php
route('admin.dashboard')
route('admin.pelanggan.index')
route('admin.pelanggan.create')
route('admin.pelanggan.store')
route('admin.pelanggan.edit', $item)
route('admin.pelanggan.update', $item)
route('admin.pelanggan.destroy', $item)
```

### Assets
```php
asset('assets-dasher/images/brand/logo/logo-icon.svg')
asset('assets-dasher/images/avatar/avatar-1.jpg')
```

### Route Checking
```php
request()->routeIs('admin.dashboard')
request()->routeIs('admin.pelanggan.*')
```

---

## 📋 Checklist

### Setup
- [ ] Copy assets images
- [ ] Create layout files
- [ ] Create partial files
- [ ] Update routes
- [ ] Update views

### Testing
- [ ] Layout appears correctly
- [ ] Sidebar works
- [ ] Mobile sidebar works
- [ ] Navigation works
- [ ] Icons appear
- [ ] Images appear
- [ ] Forms work
- [ ] CRUD operations work
- [ ] Responsive design works

---

## 🐛 Common Issues & Solutions

### Images Not Showing
```php
// Check path
asset('assets-dasher/images/...')

// Clear cache
php artisan cache:clear
```

### Icons Not Showing
```html
<!-- Check CDN link -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<!-- Check icon class -->
<i class="ti ti-plus"></i>
```

### Sidebar Not Working
```javascript
// Check JavaScript is loaded
// Check toggle button has class "sidebar-toggle"
// Check CSS for sidebar styling
```

### Routes Not Working
```php
// Check route names
route('admin.pelanggan.index')

// Check route prefix
Route::prefix('admin')->name('admin.')->group(function () {
    // Routes
});
```

---

## 📚 File Locations

### Layout Files
- `resources/views/layouts/dasher/app.blade.php`
- `resources/views/layouts/dasher/sidebar.blade.php`
- `resources/views/layouts/dasher/header.blade.php`
- `resources/views/layouts/dasher/mobile-sidebar.blade.php`

### Asset Files
- `public/assets-dasher/images/`

### Route Files
- `routes/web.php`

### View Files
- `resources/views/admin/pelanggan/index.blade.php`
- `resources/views/admin/pelanggan/create.blade.php`
- `resources/views/admin/pelanggan/edit.blade.php`

---

## 🎬 Video Recording Tips

1. **Screen Setup**
   - Code editor on left (70%)
   - Browser on right (30%)
   - Terminal at bottom

2. **Recording Flow**
   - Show file structure first
   - Create files one by one
   - Explain each step
   - Test after each major step

3. **Code Highlighting**
   - Use cursor to highlight
   - Zoom in for important parts
   - Pause when typing code
   - Explain what each part does

4. **Testing**
   - Show browser after each step
   - Test functionality
   - Show responsive design
   - Show different pages

---

**Good Luck with Your Video! 🎥🎬**

