@extends('layouts.app')

@section('title', data_get($hero, 'title', 'Beranda - Jelajahi Dunia Bersama TravelKu'))

@section('content')

{{-- NOTIFIKASI SUKSES --}}
@if(session('success'))
<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" style="z-index:1055; margin-top:90px;">
    <div class="toast show text-white bg-success shadow-lg border-0">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white m-auto me-3" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

{{-- HERO MODERN --}}
<section class="hero-modern position-relative d-flex align-items-center justify-content-center text-white"
    style="
        background-image: url('{{ data_get($hero, 'image') ? (filter_var(data_get($hero, 'image'), FILTER_VALIDATE_URL) ? data_get($hero, 'image') : asset('images/hero/' . data_get($hero, 'image'))) : asset('default/hero-bg.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 90vh;
    ">

    <div class="hero-overlay"></div>

    <div class="container position-relative text-center">
        <h1 class="fw-bold display-3 mb-3" data-aos="fade-up">
            @php
                $words = [ data_get($hero, 'word1', 'Jelajahi') ];
            @endphp
            @foreach ($words as $w)
                <span class="word-modern">{{ $w }}</span>
            @endforeach
        </h1>

        <p class="hero-subtext fs-5 mb-4" data-aos="fade-up" data-aos-delay="100">
            {{ data_get($hero, 'deskripsi', 'Ciptakan pengalaman terbaik untuk setiap perjalanan Anda.') }}
        </p>

        <form class="search-modern mx-auto" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="200">
            <div class="input-group input-group-lg shadow-lg rounded-pill overflow-hidden bg-white">
                <input type="text" class="form-control border-0 px-4 py-3"
                    placeholder="{{ data_get($hero, 'search_placeholder', 'Cari destinasi impian...') }}">
                <button class="btn btn-primary px-4">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

</section>

<style>
/* =======================================================
   GLOBAL FONT — Modern, Clean, Consistent
======================================================= */
body {
    font-family: 'Inter', 'Poppins', sans-serif;
    letter-spacing: 0.2px;
    color: #2E2E2E;
}

/* =======================================================
   HEADINGS
======================================================= */
h1, .display-3 { font-weight: 700; letter-spacing: -0.5px; }
h2.section-title { font-weight: 700; font-size: 2.2rem; letter-spacing: -0.3px; margin-bottom: 10px; }
.section-subtitle { font-size: 1.05rem; color: #6c757d; margin-top: -4px; }

/* =======================================================
   HERO AREA
======================================================= */
.hero-modern { position: relative; }
.hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.45); backdrop-filter: blur(2px); }
.word-modern { font-size: 3.2rem; font-weight: 700; letter-spacing: -1px; display: inline-block; animation: fadeUpWord 1s ease forwards; }
.hero-subtext { font-size: 1.15rem; font-weight: 400; opacity: 0.9; letter-spacing: 0.3px; }

@keyframes fadeUpWord { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

/* =======================================================
   CONSISTENT CARD HEIGHT (Destination + Packages)
======================================================= */
.modern-card, .package-modern { display: flex; flex-direction: column; height: 100%; }
.modern-card-img img, .package-modern .img-wrapper img { width: 100%; height: 230px; object-fit: cover; border-radius: 18px; }
.modern-card-body, .package-body { padding: 15px 5px; flex-grow: 1; }
.modern-card h3 { font-size: 1.4rem; font-weight: 600; }
.modern-card p, .package-modern p { font-size: 0.95rem; color: #6c757d; line-height: 1.45; }
.package-modern h5 { font-size: 1.1rem; font-weight: 600; }
.price-modern { font-size: 1.2rem; font-weight: 700; letter-spacing: -0.3px; }
.package-footer { display: flex; justify-content: space-between; align-items: center; }

/* =======================================================
   FEATURE SECTION
======================================================= */
.feature-modern h5 { font-size: 1.15rem; font-weight: 600; }
.feature-modern p { font-size: 0.95rem; color: #6c757d; }
</style>

{{-- DESTINASI UTAMA --}}
@php
// Hanya ambil paket featured
$top_destinations = $all_packages->where('is_featured', 1);
@endphp

<section class="section-modern section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Destinasi Utama Kami</h2>
            <p class="section-subtitle">Temukan destinasi paling populer pilihan wisatawan</p>
        </div>

        <div class="row g-4">
            @foreach ($top_destinations as $destination)
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}">
                <a href="{{ route('paket.show', $destination->slug ?? '#') }}" class="modern-card">
                    <div class="modern-card-img">
                        <img src="{{ asset('images/paket/' . ($destination->image ?? 'default.jpg')) }}" alt="{{ $destination->name }}">
                    </div>
                    <div class="modern-card-body">
                        <h3>{{ $destination->name }}</h3>
                        <p>{{ Str::limit($destination->description, 85) }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PAKET WISATA --}}
<section id="paket-wisata" class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Paket Wisata Pilihan</h2>
            <p class="section-subtitle">Pilihan terbaik untuk liburan Anda</p>
        </div>

        <div class="row g-4">
            @forelse($all_packages->take(6) as $package)
<div class="col-lg-4 col-md-6">
    <div class="package-modern">
        <div class="img-wrapper">
            <img src="{{ asset('images/paket/' . data_get($package,'image','default.jpg')) }}" alt="">
            <span class="badge-days">{{ data_get($package,'duration',0) }} Hari</span>
        </div>

        <div class="package-body">
            <h5 class="fw-bold">{{ data_get($package,'name','Paket Wisata') }}</h5>
            <p class="text-muted">{{ Str::limit(data_get($package,'description',''), 85) }}</p>

            <div class="package-footer">
                <div>
                    <div class="small text-muted">Mulai dari</div>
                    <div class="fw-bold price-modern">Rp {{ number_format(data_get($package,'price',0),0,',','.') }}</div>
                </div>
                <a href="{{ route('paket.show', data_get($package,'slug','#')) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat</a>
            </div>
        </div>
    </div>
</div>
@empty
<p class="text-center">Belum ada paket wisata tersedia.</p>
@endforelse

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('packages.index') }}" class="btn btn-primary rounded-pill px-4 py-2">Lihat Semua Paket</a>
        </div>
    </div>
</section>

{{-- KENAPA PILIH KAMI --}}
<section id="kenapa-pilih-kami" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Kenapa Memilih TravelKu?</h2>
            <p class="section-subtitle">Kami memberikan pengalaman terbaik untuk setiap perjalanan</p>
        </div>

        <div class="row g-4 text-center">
            @foreach ($features as $index => $feature)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                <div class="feature-modern">
                    <div class="icon-wrapper">
                        <i class="{{ $feature['icon'] }}"></i>
                    </div>
                    <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                    <p class="text-muted">{{ $feature['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
