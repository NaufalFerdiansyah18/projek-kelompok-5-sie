<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('assets-dasher/images/favicon/favicon-32x32.png') }}">

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tabler Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<!-- SimpleBar CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.css">

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- Custom Dasher CSS -->
<style>
    :root {
        --font-public-sans: 'Public Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    body {
        font-family: var(--font-public-sans);
        background-color: #f8f9fa;
    }
    
    .navbar-glass {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        z-index: 1030;
        position: sticky;
        top: 0;
    }
    
    #miniSidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 280px;
        background: #fff;
        border-right: 1px solid #e9ecef;
        z-index: 1000;
        overflow-y: auto;
        transition: all 0.3s ease;
    }
    
    html.collapsed #miniSidebar {
        width: 80px;
    }
    
    html.collapsed #miniSidebar .text,
    html.collapsed #miniSidebar .site-logo-text {
        display: none;
    }
    
    html.collapsed #miniSidebar .nav-link {
        justify-content: center;
        padding: 12px;
    }
    
    #content {
        margin-left: 280px;
        min-height: 100vh;
        transition: margin-left 0.3s ease;
        position: relative;
        z-index: 1;
    }
    
    html.collapsed #content {
        margin-left: 80px;
    }
    
    .custom-container {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 24px;
    }
    
    @media (max-width: 768px) {
        .custom-container {
            padding: 0 16px;
        }
    }
    
    .brand-logo {
        padding: 24px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .site-logo-text {
        color: #495057;
    }
    
    .navbar-nav .nav-link {
        padding: 12px 24px;
        color: #495057;
        display: flex;
        align-items: center;
        gap: 12px;
        border-radius: 8px;
        margin: 4px 12px;
    }
    
    .navbar-nav .nav-link:hover {
        background-color: #d1fae5;
        color: #059669;
    }
    
    .navbar-nav .nav-link:hover .nav-icon i,
    .navbar-nav .nav-link:hover .text {
        color: #059669;
    }
    
    .navbar-nav .nav-link.active {
        background-color: #d1fae5;
        color: #059669;
        font-weight: 500;
    }
    
    .navbar-nav .nav-link.active .nav-icon i,
    .navbar-nav .nav-link.active .text {
        color: #059669;
    }
    
    .nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
    }
    
    .nav-heading {
        padding: 12px 24px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        color: #6c757d;
        letter-spacing: 0.5px;
    }
    
    .nav-line {
        border-color: #e9ecef;
        margin: 8px 24px;
    }
    
    .dropdown-menu {
        border: 1px solid #e9ecef;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        background: #fff;
        padding: 0;
        border-radius: 8px;
        margin-top: 8px;
        z-index: 1050 !important;
        position: absolute;
    }
    
    .dropdown {
        position: relative;
        z-index: 1050;
    }
    
    .dropdown-menu .nav-link {
        padding-left: 48px;
    }
    
    .dropdown-item {
        padding: 10px 16px;
        color: #495057;
        transition: background-color 0.2s;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    
    .upgrade-ui {
        margin: 24px 12px;
        padding: 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        background-color: #667eea;
        border-radius: 12px;
        color: white;
        text-align: center;
        opacity: 1;
    }
    
    .upgrade-ui h5 {
        color: white;
        font-weight: 600;
    }
    
    .upgrade-ui .text-secondary {
        color: rgba(255, 255, 255, 0.9) !important;
    }
    
    .upgrade-ui .btn-light {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
    }
    
    .upgrade-ui .btn-light:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
    }
    
    .sidebar-toggle {
        cursor: pointer;
        display: flex;
        align-items: center;
        padding: 8px;
        border-radius: 8px;
        transition: background-color 0.2s;
    }
    
    .sidebar-toggle:hover {
        background-color: #f8f9fa;
    }
    
    html:not(.collapsed) .collapse-mini {
        display: none;
    }
    
    html.collapsed .collapse-expanded {
        display: none;
    }
    
    html.collapsed .collapse-mini {
        display: block;
    }
    
    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .avatar-md {
        width: 48px;
        height: 48px;
    }
    
    .avatar-lg {
        width: 64px;
        height: 64px;
    }
    
    .btn-icon {
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-ghost {
        background: transparent;
        border: none;
        color: #495057;
    }
    
    .btn-ghost:hover {
        background-color: #f8f9fa;
        color: #495057;
    }
    
    .dropdown > a {
        padding: 8px 12px;
        border-radius: 8px;
        transition: background-color 0.2s;
    }
    
    .dropdown > a:hover {
        background-color: #f8f9fa;
    }
    
    .mb-6 {
        margin-bottom: 2rem;
    }
    
    .table th {
        font-weight: 600;
        color: #495057;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    @media (max-width: 991px) {
        #miniSidebar {
            display: none;
        }
        
        #content {
            margin-left: 0;
        }
    }
</style>

@stack('styles')

