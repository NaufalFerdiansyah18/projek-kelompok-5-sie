<nav class="navbar navbar-expand-lg navbar-glass px-0 px-lg-4">
    <div class="container-fluid px-lg-0">
        <div class="d-flex align-items-center gap-4">
            <!-- Mobile Menu Toggle -->
            <div class="d-block d-lg-none">
                <button class="btn btn-link text-dark p-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                    <i class="ti ti-menu-2" style="font-size: 24px;"></i>
                </button>
            </div>

            <!-- Desktop Sidebar Toggle -->
            <div class="d-none d-lg-block">
                <a href="#" class="sidebar-toggle d-flex p-3 text-decoration-none">
                    <span class="collapse-mini">
                        <i class="ti ti-arrow-bar-right text-secondary" style="font-size: 20px;"></i>
                    </span>
                    <span class="collapse-expanded">
                        <i class="ti ti-arrow-bar-left text-secondary" style="font-size: 20px;"></i>
                    </span>
                </a>
            </div>
        </div>

        <!-- Right Side Actions -->
        <ul class="list-unstyled d-flex align-items-center mb-0 gap-2">

            <!-- User Menu -->
            <li>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex flex-column align-items-end d-none d-md-flex">
                            <span class="fw-semibold text-dark" style="font-size: 14px; line-height: 1.2;">
                                {{ Auth::user()->first_name ?? 'Admin' }} </span>
                            <span class="text-secondary" style="font-size: 12px; line-height: 1.2;">
                                {{ Auth::user()->email ?? '' }}</span>
                        </div>
                        <div
                            class="avatar rounded-circle bg-secondary-subtle d-flex align-items-center justify-content-center text-secondary">
                            <i class="ti ti-user" style="font-size: 20px;"></i>
                        </div>
                        <i class="ti ti-chevron-down text-secondary" style="font-size: 16px;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0"
                        style="min-width: 280px; background: #fff !important; z-index: 9999 !important;">
                        <!-- User Info -->
                        <div class="d-flex gap-3 align-items-center border-bottom border-dashed px-4 py-4"
                            style="background: #fff;">
                            <div
                                class="avatar avatar-md rounded-circle bg-secondary-subtle d-flex align-items-center justify-content-center text-secondary">
                                <i class="ti ti-user" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fs-5" style="color: #212529;">{{ Auth::user()->first_name ?? 'Admin' }}
                                </h4>
                                <p class="mb-0 text-secondary small">{{ Auth::user()->email ?? '' }}</p>
                            </div>
                        </div>

                        <!--Logout -->

                        <!-- Logout -->
                        <div class="border-top border-dashed mb-4 pt-4 px-4" style="background: #ffffff;">
                            <a href="{{ route('auth.logout') }}"
                                class="d-flex align-items-center gap-2 text-decoration-none logout-link">
                                <i class="ti ti-logout-2"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- End of Navbar -->
