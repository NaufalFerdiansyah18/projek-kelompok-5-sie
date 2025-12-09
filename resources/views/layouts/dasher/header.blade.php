<nav class="navbar navbar-expand-lg navbar-glass px-0 px-lg-4">
    <div class="container-fluid px-lg-0">
        <div class="d-flex align-items-center gap-4">
            <!-- Mobile Menu Toggle -->
            <div class="d-block d-lg-none">
                <button class="btn btn-link text-dark p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
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
            <!-- Search -->
            <li>
                <button class="btn btn-white btn-sm">
                    <i class="ti ti-search" style="font-size: 16px;"></i>
                    <small class="ms-1">⌘K</small>
                </button>
            </li>

            <!-- Notification -->
            <li>
                <button class="btn btn-ghost position-relative btn-icon rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotification" aria-controls="offcanvasNotification">
                    <i class="ti ti-bell" style="font-size: 20px;"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
                        2<span class="visually-hidden">unread messages</span>
                    </span>
                </button>
            </li>

            <!-- User Menu -->
            <li>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex flex-column align-items-end d-none d-md-flex">
                            <span class="fw-semibold text-dark" style="font-size: 14px; line-height: 1.2;"> {{Auth::user()->name}} </span>
                            <span class="text-secondary" style="font-size: 12px; line-height: 1.2;"> {{Auth::user()->email}}</span>
                        </div>
                        <img src="{{ asset('assets-dasher/images/avatar/avatar-1.jpg') }}" alt="User" class="avatar rounded-circle">
                        <i class="ti ti-chevron-down text-secondary" style="font-size: 16px;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0" style="min-width: 280px; background: #fff !important; z-index: 9999 !important;">
                        <!-- User Info -->
                        <div class="d-flex gap-3 align-items-center border-bottom border-dashed px-4 py-4" style="background: #fff;">
                            <img src="{{ asset('assets-dasher/images/avatar/avatar-1.jpg') }}" alt="User" class="avatar avatar-md rounded-circle">
                            <div>
                                <h4 class="mb-0 fs-5" style="color: #212529;">Admin User</h4>
                                <p class="mb-0 text-secondary small">admin@example.com</p>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="p-3 d-flex flex-column gap-1" style="background: #fff;">
                            <a href="#" class="dropdown-item d-flex align-items-center gap-2" style="color: #495057;">
                                <i class="ti ti-home-2"></i>
                                <span>Home</span>
                            </a>
                            <a href="#" class="dropdown-item d-flex align-items-center gap-2" style="color: #495057;">
                                <i class="ti ti-inbox"></i>
                                <span>Inbox</span>
                            </a>
                            <a href="#" class="dropdown-item d-flex align-items-center gap-2" style="color: #495057;">
                                <i class="ti ti-message"></i>
                                <span>Chat</span>
                            </a>
                            <a href="#" class="dropdown-item d-flex align-items-center gap-2" style="color: #495057;">
                                <i class="ti ti-activity"></i>
                                <span>Activity</span>
                            </a>
                            <a href="#" class="dropdown-item d-flex align-items-center gap-2" style="color: #495057;">
                                <i class="ti ti-settings"></i>
                                <span>Account Settings</span>
                            </a>
                        </div>

                        <!-- Logout -->
                        <div class="border-top border-dashed mb-4 pt-4 px-4" style="background: #fff;">
                            <a href="#" class="text-secondary d-flex align-items-center gap-2 text-decoration-none">
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

<!-- Notification Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotification" aria-labelledby="offcanvasNotificationLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offcanvasNotificationLabel">Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav nav-tabs nav-line-bottom border-bottom" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#notif-all" type="button" role="tab">All</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#notif-following" type="button" role="tab">Following</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#notif-archive" type="button" role="tab">Archive</button>
            </li>
        </ul>
        <div class="tab-content p-4" style="max-height: 500px; overflow-y: auto;">
            <div class="tab-pane fade show active" id="notif-all" role="tabpanel">
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-bottom border-dashed p-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>New message from John Doe</div>
                                <small class="text-secondary">2 minutes ago</small>
                            </div>
                            <span class="badge bg-info rounded-circle" style="width: 10px; height: 10px;"></span>
                        </div>
                    </div>
                    <div class="list-group-item border-bottom border-dashed p-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Your password will expire soon.</div>
                                <small class="text-secondary">5 minutes ago</small>
                            </div>
                            <span class="badge bg-info rounded-circle" style="width: 10px; height: 10px;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="notif-following" role="tabpanel">
                <p class="text-center text-muted py-4">No notifications</p>
            </div>
            <div class="tab-pane fade" id="notif-archive" role="tabpanel">
                <p class="text-center text-muted py-4">No archived notifications</p>
            </div>
        </div>
    </div>
</div>

