<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - TravelKu')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom Admin CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h3>TravelKu</h3>
            </div>
            <ul class="sidebar-menu">
                <li class="{{ Route::is('admin.home') ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
               
                <!-- INI ADALAH MENU PAKET WISATA YANG SUDAH DIPERBAIKI -->
                <li class="{{ Route::is('admin.paket*') ? 'active' : '' }}">
                    <a href="{{ route('admin.paket.index') }}">
                        <i class="bi bi-suitcase"></i>
                        <span>Paket Wisata</span>
                    </a>
                </li>
           
                </li>
          <li class="{{ Route::is('admin.footer*') ? 'active' : '' }}">
    <a href="{{ route('admin.footer.edit') }}">
        <i class="bi bi-gear"></i>
        <span>Pengaturan</span>
    </a>
</li>

            </ul>
        </nav>

        <!-- Main Content -->
        <main class="admin-main" id="adminMain">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Admin JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('adminSidebar');
            const mainContent = document.getElementById('adminMain');
            const toggleBtn = document.querySelector('.toggle-btn');

            toggleBtn?.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('full-width');
            });
        });
    </script>
</body>
</html>