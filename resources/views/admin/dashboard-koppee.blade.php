@extends('layouts.koppee.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="h3 mb-2">Dashboard</h1>
        <p class="text-muted">Selamat datang di Dashboard Guest UI</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-6">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Users</h6>
                            <h2 class="mb-0">2,350</h2>
                            <small class="text-success">
                                <i class="ti ti-arrow-up"></i> 22% from last month
                            </small>
                        </div>
                        <div class="icon-shape bg-primary-subtle text-primary rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-users" style="font-size: 28px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Revenue</h6>
                            <h2 class="mb-0">$53,000</h2>
                            <small class="text-success">
                                <i class="ti ti-arrow-up"></i> 28% from last month
                            </small>
                        </div>
                        <div class="icon-shape bg-success-subtle text-success rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-currency-dollar" style="font-size: 28px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Products</h6>
                            <h2 class="mb-0">{{ \App\Models\Product::count() }}</h2>
                            <small class="text-info">
                                <i class="ti ti-package"></i> Total products
                            </small>
                        </div>
                        <div class="icon-shape bg-info-subtle text-info rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-shopping-bag" style="font-size: 28px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th>Views</th>
                                    <th>Value</th>
                                    <th>Bounce Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>/admin/dashboard</td>
                                    <td>3,225</td>
                                    <td>$20</td>
                                    <td>
                                        <span class="badge bg-success">42.55%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>/admin/products</td>
                                    <td>2,150</td>
                                    <td>$15</td>
                                    <td>
                                        <span class="badge bg-warning">58.20%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>/admin/users</td>
                                    <td>1,800</td>
                                    <td>$10</td>
                                    <td>
                                        <span class="badge bg-danger">65.30%</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-2"></i> Add Product
                        </a>
                        <a href="{{ route('user.create') }}" class="btn btn-outline-primary">
                            <i class="ti ti-user-plus me-2"></i> Add User
                        </a>
                        <a href="{{ route('umkm.create') }}" class="btn btn-outline-primary">
                            <i class="ti ti-building-store me-2"></i> Add UMKM
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

