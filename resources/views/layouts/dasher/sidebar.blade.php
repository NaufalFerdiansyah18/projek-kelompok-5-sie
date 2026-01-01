<nav id="miniSidebar" class="navbar-nav">
    <div>
        <!-- Brand Logo -->
        <div class="brand-logo">
            <a href="{{ route('admin.dashboard') }}" class="d-none d-md-flex align-items-center gap-2 text-decoration-none">
                <i class="ti ti-building-store text-success" style="font-size: 32px;"></i>
                <span class="fw-bold fs-4 site-logo-text">UMKM</span>
            </a>
        </div>

        <!-- Navigation Menu -->
        <ul class="navbar-nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-home" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <!-- Pelanggan -->
            <li class="nav-item">
                <a href="{{ route('admin.pelanggan.index') }}" class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-users" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Pelanggan</span>
                </a>
            </li>

            <!-- UMKM -->
            <li class="nav-item">
                <a href="{{ route('admin.umkm.index') }}" class="nav-link {{ request()->routeIs('admin.umkm.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-building-store" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">UMKM</span>
                </a>
            </li>

            <!-- User -->
            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-user" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">User</span>
                </a>
            </li>

            <!-- Products -->
            <li class="nav-item">
                <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-shopping-bag" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Produk</span>
                </a>
            </li>

            <!-- Pesanan (Admin) -->
            <li class="nav-item">
                <a href="{{ route('admin.pesanan.index') }}" class="nav-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-receipt" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Pesanan</span>
                </a>
            </li>

            <!-- Ulasan Produk (Admin) -->
            <li class="nav-item">
                <a href="{{ route('admin.ulasan.index') }}" class="nav-link {{ request()->routeIs('admin.ulasan.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-star" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Ulasan Produk</span>
                </a>
            </li>
            <!-- Warga -->
            <li class="nav-item">
                <a href="{{ route('admin.warga.index') }}" class="nav-link {{ request()->routeIs('admin.warga.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-users" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Warga</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
