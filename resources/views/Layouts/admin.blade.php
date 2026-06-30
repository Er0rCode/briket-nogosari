<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Briket Nogosari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #2E7D32;
            --dark-charcoal: #121212;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f5f7f9;
            overflow-x: hidden;
        }

        .sidebar { 
            width: var(--sidebar-width);
            min-height: 100vh; 
            background-color: var(--dark-charcoal); 
            color: white; 
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
        }

        @media (max-width: 767.98px) {
            .sidebar { left: calc(var(--sidebar-width) * -1); }
            .sidebar.show { left: 0; }
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: 1.25rem;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-link { 
            color: rgba(255,255,255,0.6); 
            font-weight: 500; 
            padding: 12px 20px; 
            margin: 4px 16px;
            border-radius: 10px;
            transition: all 0.3s ease; 
        }

        .sidebar .nav-link:hover { 
            color: #fff; 
            background-color: rgba(255,255,255,0.05); 
            transform: translateX(4px);
        }

        .sidebar .nav-link.active { 
            color: #fff; 
            background-color: var(--primary-color);
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        @media (max-width: 767.98px) {
            .main-content { margin-left: 0; }
        }

        .navbar-admin { 
            background-color: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 15px 24px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .btn-toggle-sidebar {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            color: #333;
            border-radius: 8px;
            padding: 8px 12px;
            transition: 0.2s;
        }

        .btn-toggle-sidebar:hover { background: #e9ecef; }
        
        .sidebar-overlay {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.5); z-index: 1035; display: none; opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.show { display: block; opacity: 1; }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand text-center">
        <h5 class="fw-bold mb-0 text-white d-flex align-items-center justify-content-center">
            <i class="fas fa-fire text-warning me-2 fs-4"></i>
            Admin Briket
        </h5>
    </div>
    <div class="nav flex-column py-3 mt-2">
        <span class="text-uppercase small fw-bold px-4 mb-2 text-white-50" style="font-size: 0.75rem; letter-spacing: 1px;">Menu Utama</span>
        
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt me-3 fa-fw"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
            <i class="fas fa-box me-3 fa-fw"></i> Kelola Produk
        </a>
        <a class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}">
            <i class="fas fa-images me-3 fa-fw"></i> Kelola Galeri
        </a>
        
        <span class="text-uppercase small fw-bold px-4 mt-4 mb-2 text-white-50" style="font-size: 0.75rem; letter-spacing: 1px;">Pengaturan Website</span>
        
        <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
            <i class="fas fa-user-edit me-3 fa-fw"></i> Profil Usaha
        </a>
        <a class="nav-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}" href="{{ route('admin.contact.edit') }}">
            <i class="fas fa-address-book me-3 fa-fw"></i> Kontak & Lokasi
        </a>
        
        <div class="px-3 mt-5">
            <a class="btn btn-danger w-100 fw-semibold rounded-3 d-flex justify-content-center align-items-center py-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Keluar Sistem
            </a>
        </div>
    </div>
</aside>

<main class="main-content">
    <nav class="navbar navbar-expand navbar-light navbar-admin d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="btn btn-toggle-sidebar d-md-none me-3" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <span class="navbar-brand mb-0 h5 fw-bold text-dark d-none d-sm-block">Panel Kontrol Manajemen</span>
        </div>
        
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle fw-semibold rounded-pill px-3 shadow-sm border-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                <div class="bg-success rounded-circle me-2 d-flex align-items-center justify-content-center text-white" style="width: 28px; height: 28px; font-size: 0.8rem;">
                    <i class="fas fa-user"></i>
                </div>
                Administrator
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2 rounded-3">
                <li><h6 class="dropdown-header">Opsi Akun</h6></li>
                <li>
                    <a class="dropdown-item text-danger fw-medium" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="p-4 p-md-5">
        @yield('content')
    </div>
</main>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleMenu() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        if(toggleBtn) toggleBtn.addEventListener('click', toggleMenu);
        if(overlay) overlay.addEventListener('click', toggleMenu);
    });
</script>
</body>
</html>