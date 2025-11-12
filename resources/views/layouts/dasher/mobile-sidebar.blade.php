<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                <img src="{{ asset('assets-dasher/images/brand/logo/logo-icon.svg') }}" alt="Dasher" height="32">
                <span class="fw-bold fs-4">Dasher</span>
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
                    <i class="ti ti-files me-2" style="font-size: 20px;"></i>
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
                <a href="{{ route('umkm.index') }}" class="nav-link {{ request()->routeIs('umkm.*') ? 'active' : '' }}">
                    <i class="ti ti-building-store me-2" style="font-size: 20px;"></i>
                    <span>UMKM</span>
                </a>
            </li>

            <!-- User -->
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                    <i class="ti ti-user me-2" style="font-size: 20px;"></i>
                    <span>User</span>
                </a>
            </li>

            <!-- Products -->
            <li class="nav-item">
                <a href="{{ route('produk.index') }}" class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                    <i class="ti ti-shopping-bag me-2" style="font-size: 20px;"></i>
                    <span>Produk</span>
                </a>
            </li>
        </ul>
    </div>
</div>

