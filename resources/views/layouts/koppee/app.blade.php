<!DOCTYPE html>
<html lang="en" class="expanded">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'koppee - Admin Dashboard')</title>
    <meta name="description" content="@yield('meta_description', 'koppee - Responsive Bootstrap 5 Admin Dashboard')">

    @include('layouts.koppee.css')
</head>

<body>
    <!-- Sidebar -->
    @include('layouts.koppee.sidebar')

    <!-- Mobile Sidebar -->
    @include('layouts.koppee.mobile-sidebar')

    <!-- Content -->
    <div id="content" class="position-relative">
        <!-- Header -->
        @include('layouts.koppee.header')

        <!-- Main Content -->
        <div class="custom-container py-4">
            @yield('content')
        </div>

        @include('layouts.koppee.footer')
    </div>

    @include('layouts.koppee.js')
</body>

</html>

