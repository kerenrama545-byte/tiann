@extends('layouts.auth')

@section('title', 'Masuk - TravelKu')

@section('content')
<div class="auth-container">
    <!-- Sisi Kiri: Gambar dan Teks -->
    <div class="auth-image-side" data-aos="fade-right">
        <i class="bi bi-airplane airplane-icon"></i>
        <h1 class="fw-bold">Selamat Datang Kembali!</h1>
        <p class="lead">Masuk untuk melanjutkan petualangan Anda dan temukan penawaran terbaru dari kami.</p>
    </div>

    <!-- Sisi Kanan: Form Login -->
    <div class="auth-form-side" data-aos="fade-left">
        <div class="auth-form-card">
            <!-- Logo di Mobile -->
            <div class="text-center mb-4 d-lg-none">
                <h3 class="fw-bold" style="color: var(--primary-color);">TravelKu</h3>
            </div>
            
            <!-- TAMPILKAN NOTIFIKASI ERROR DI SINI -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Oops!</strong> {{ $errors->first() }} <!-- Menampilkan error pertama -->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <h3 class="fw-bold mb-4">Masuk</h3>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                    <label class="form-check-label" for="rememberMe">Ingat saya</label>
                </div>
                <button type="submit" class="btn btn-primary mb-3 w-100">Masuk</button>
                <div class="text-center auth-links">
                    <a href="#">Lupa kata sandi?</a>
                </div>
                <hr>
                <p class="text-center mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
            </form>
        </div>
    </div>
</div>
@endsection