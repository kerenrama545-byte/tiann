@extends('layouts.auth')

@section('title', 'Daftar - TravelKu')

@section('content')
<div class="auth-container">
    <!-- Sisi Kiri: Gambar dan Teks -->
    <div class="auth-image-side" data-aos="fade-right">
       <i class="bi bi-airplane airplane-icon"></i>
        <h1 class="fw-bold">Bergabung dengan TravelKu!</h1>
        <p class="lead">Buat akun sekarang untuk mulai merencanakan perjalanan impian Anda.</p>
    </div>

    <!-- Sisi Kanan: Form Register -->
    <div class="auth-form-side" data-aos="fade-left">
        <div class="auth-form-card">
            <!-- Logo di Mobile -->
            <div class="text-center mb-4 d-lg-none">
                <h3 class="fw-bold" style="color: var(--primary-color);">TravelKu</h3>
            </div>

            <h3 class="fw-bold mb-4">Daftar</h3>

            <!-- FORM SUDAH DIBENARKAN -->
            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" name="email" placeholder="nama@email.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" name="password" placeholder="Minimal 8 karakter" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                </div>

                <button type="submit" class="btn btn-primary mb-3">Daftar</button>

                <hr>

                <p class="text-center mb-0">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
