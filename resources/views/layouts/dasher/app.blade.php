<!DOCTYPE html>
<html lang="en" class="expanded">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dasher - Admin Dashboard')</title>
    <meta name="description" content="@yield('meta_description', 'Dasher - Responsive Bootstrap 5 Admin Dashboard')">
    
    @include('layouts.dasher.css')
</head>

<body>
    <!-- Sidebar -->
    @include('layouts.dasher.sidebar')
    
    <!-- Mobile Sidebar -->
    @include('layouts.dasher.mobile-sidebar')
    
    <!-- Content -->
    <div id="content" class="position-relative">
        <!-- Header -->
        @include('layouts.dasher.header')
        
        <!-- Main Content -->
        <div class="custom-container py-4">
            @yield('content')
        </div>
        
        @include('layouts.dasher.footer')
    </div>
    
    @include('layouts.dasher.js')
</body>

</html>

