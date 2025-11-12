<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Volt - Free Bootstrap 5 Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="@yield('meta_title', 'Volt - Free Bootstrap 5 Dashboard')">
    <meta name="author" content="Themesberg">

    @yield('css')
</head>

<body>
    @include('layouts.admin.header')

    <main class="content">
        @yield('content')
        @include('layouts.admin.footer')
    </main>

    @include('layouts.admin.js')
</body>

</html>
