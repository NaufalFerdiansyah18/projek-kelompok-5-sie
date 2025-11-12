<nav id="miniSidebar" class="navbar-nav">
    <div>
        <!-- Brand Logo -->
        <div class="brand-logo">
            <a href="{{ route('admin.dashboard') }}" class="d-none d-md-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('assets-dasher/images/brand/logo/logo-icon.svg') }}" alt="Dasher" height="32">
                <span class="fw-bold fs-4 site-logo-text">Dasher</span>
            </a>
        </div>

        <!-- Navigation Menu -->
        <ul class="navbar-nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-files" style="font-size: 20px;"></i>
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
                <a href="{{ route('umkm.index') }}" class="nav-link {{ request()->routeIs('umkm.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-building-store" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">UMKM</span>
                </a>
            </li>

            <!-- User -->
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-user" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">User</span>
                </a>
            </li>

            <!-- Products -->
            <li class="nav-item">
                <a href="{{ route('produk.index') }}" class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-shopping-bag" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Produk</span>
                </a>
            </li>
            <!-- User -->
            <li class="nav-item">
                <a href="{{ route('warga.index') }}" class="nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="ti ti-user" style="font-size: 20px;"></i>
                    </span>
                    <span class="text">Warga</span>
                </a>
            </li>


            <!-- Divider -->
            <li class="nav-item">
                <div class="nav-heading">Pages</div>
                <hr class="mx-5 nav-line mb-1">
            </li>

            <!-- Upgrade UI Card -->
            <li class="nav-item">
                <div class="text-center py-5 upgrade-ui">
                    <div>
                        <img src="{{ asset('assets-dasher/images/avatar/avatar-1.jpg') }}" alt="User" class="avatar avatar-md rounded-circle mb-3">
                        <div class="my-3">
                            <h5 class="mb-1 fs-6">Admin User</h5>
                            <span class="text-secondary">Dasher UI - Free Version</span>
                        </div>
                        <a href="#" class="btn btn-light btn-sm">Upgrade</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>


