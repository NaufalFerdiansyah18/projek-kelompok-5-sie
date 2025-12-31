<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                <i class="ti ti-building-store text-success" style="font-size: 32px;"></i>
                <span class="fw-bold fs-4">UMKM</span>
            </a>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <!-- Navigation Menu -->
        <ul class="navbar-nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="ti ti-building-store text-success me-2" style="font-size: 20px;"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Pelanggan -->
            <li class="nav-item">
                <a href="{{ route('admin.pelanggan.index') }}" class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                    <i class="ti ti-users me-2" style="font-size: 20px;"></i>
                    <span>Pelanggan</span>
                </a>
            </li>

            <!-- UMKM -->
            <li class="nav-item">
                <a href="{{ route('admin.umkm.index') }}" class="nav-link {{ request()->routeIs('admin.umkm.*') ? 'active' : '' }}">
                    <i class="ti ti-building-store me-2" style="font-size: 20px;"></i>
                    <span>UMKM</span>
                </a>
            </li>

            <!-- User -->
            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <i class="ti ti-user me-2" style="font-size: 20px;"></i>
                    <span>User</span>
                </a>
            </li>

            <!-- Products -->
            <li class="nav-item">
                <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                    <i class="ti ti-shopping-bag me-2" style="font-size: 20px;"></i>
                    <span>Produk</span>
                </a>
            </li>

            <!-- Warga -->
            <li class="nav-item">
                <a href="{{ route('admin.warga.index') }}" class="nav-link {{ request()->routeIs('admin.warga.*') ? 'active' : '' }}">
                    <i class="ti ti-users me-2" style="font-size: 20px;"></i>
                    <span>Warga</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.pesanan.index') }}" class="nav-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                    <i class="ti ti-receipt me-2" style="font-size: 20px;"></i>
                    <span>Pesanan</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.ulasan.index') }}" class="nav-link {{ request()->routeIs('admin.ulasan.*') ? 'active' : '' }}">
                    <i class="ti ti-star me-2" style="font-size: 20px;"></i>
                    <span>Ulasan Produk</span>
                </a>
            </li>
        </ul>
    </div>
</div>
