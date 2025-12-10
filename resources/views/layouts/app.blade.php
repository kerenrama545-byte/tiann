<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TravelKu - Agen Wisata Terpercaya' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Overlay Sidebar -->
    <div id="sidebar-overlay"></div>

    <!-- Sidebar Mobile -->
    <nav id="sidebar-menu">
        <button class="sidebar-close-btn"><i class="bi bi-x-lg"></i></button>
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">{{ $title ?? 'TravelKu' }}</a>

        <ul class="navbar-nav mt-3">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house me-2"></i>Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#tempat-wisata"><i class="bi bi-geo-alt me-2"></i>Tempat Wisata</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#paket-wisata"><i class="bi bi-suitcase me-2"></i>Paket Wisata</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}"><i class="bi bi-building me-2"></i>Tentang Kami</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}"><i class="bi bi-envelope me-2"></i>Gallery</a></li>

            <hr class="my-3">

            <!-- AUTH LOGIC SIDEBAR -->
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-person-circle me-2"></i>Hi, {{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-link nav-link text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus me-2"></i>Register</a></li>
            @endauth
        </ul>
    </nav>

    <!-- Navbar Desktop -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">{{ $title ?? 'TravelKu' }}</a>

            <!-- Mobile Toggle -->
            <button class="custom-toggler d-lg-none">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse d-none d-lg-flex">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#tempat-wisata">Tempat Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#paket-wisata">Paket Wisata</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>

                    <!-- AUTH LOGIC NAVBAR DESKTOP -->
                    @auth
                        <li class="nav-item ms-3">
                            <a class="nav-link" href="#">Hi, {{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item ms-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger px-3">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a class="btn btn-outline-primary px-3" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary px-3" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- Back to Top -->
    <button id="back-to-top" class="btn btn-primary"><i class="bi bi-arrow-up"></i></button>

  <!-- Footer -->
<footer class="footer">
    <div class="container text-center">
        <h3 class="mb-3">{{ $title ?? 'TravelKu' }}</h3>
        <p>{{ $motto2 ?? 'Jelajahi dunia tanpa batas.' }}</p>

        <div class="mb-4">
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $footer->email }}" target="_blank">
    <i class="bi bi-envelope"></i>
</a>

              @php
    $wa = $footer->whatsapp ?? '081234567890';
    $wa_link = (substr($wa,0,1) == '0' ? '62'.substr($wa,1) : $wa);
@endphp

            <a href="https://wa.me/{{ $wa_link }}" target="_blank" class="fs-5 mx-2" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>

            <a href="https://instagram.com/{{ $footer->instagram ?? 'username' }}" target="_blank" class="fs-5 mx-2" title="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://facebook.com/{{ $footer->facebook ?? 'username' }}" target="_blank" class="fs-5 mx-2" title="Facebook"><i class="bi bi-facebook"></i></a>
        </div>

        <hr style="border-color:#495057;">
        <p class="mb-0">&copy; {{ date('Y') }} {{ $title ?? 'TravelKu' }}. All Rights Reserved.</p>
    </div>
</footer>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            AOS.init({ duration: 1000, once: true });

            const customToggler = document.querySelector('.custom-toggler');
            const sidebarMenu = document.getElementById('sidebar-menu');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const sidebarCloseBtn = document.querySelector('.sidebar-close-btn');
            const mainNavbar = document.getElementById('main-navbar');
            const backToTopBtn = document.getElementById('back-to-top');

            // Open sidebar
            customToggler?.addEventListener('click', () => {
                sidebarMenu.classList.add('show');
                sidebarOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            });

            // Close sidebar
            const closeSidebar = () => {
                sidebarMenu.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                document.body.style.overflow = 'auto';
            };

            sidebarCloseBtn?.addEventListener('click', closeSidebar);
            sidebarOverlay?.addEventListener('click', closeSidebar);

            // Navbar scroll effect
            window.addEventListener('scroll', () => {
                mainNavbar.classList.toggle('navbar-scrolled', window.scrollY > 50);
                backToTopBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
            });

            // Back to top
            backToTopBtn?.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Smooth scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    target?.scrollIntoView({ behavior: 'smooth' });
                });
            });
        });
    </script>
</body>
</html>
