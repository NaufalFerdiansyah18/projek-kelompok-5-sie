<!--

=========================================================
* Volt Pro - Premium Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)
* License (https://themes.getbootstrap.com/licenses/)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.

-->
<!DOCTYPE html>
<html lang="en" class="expanded">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Dasher</title>
    @include('layouts.dasher.css')
</head>
<body class="bg-light">
    <main class="min-vh-100 d-flex align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                @yield('content')
            </div>
        </div>
    </main>
    @include('layouts.dasher.js')
</body>
</html>
