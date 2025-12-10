@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<section class="about-hero position-relative text-white" style="
    background-image: url('{{ asset('images/hero/' . ($hero->image ?? 'default.jpg')) }}');
    background-size: cover;
    background-position: center;
    min-height: 70vh;
">
    <div class="overlay" style="position:absolute; inset:0; background:rgba(0,0,0,0.5);"></div>
    <div class="container position-relative d-flex flex-column justify-content-center align-items-start h-100">
        <h1 class="fw-bold display-4 mb-3" data-aos="fade-up">
            {{ $hero->title ?? 'About Us' }}
        </h1>
        <p class="lead mb-0" style="max-width:600px;" data-aos="fade-up" data-aos-delay="100">
            {{ $hero->deskripsi ?? 'Informasi perusahaan belum ditambahkan.' }}
        </p>
    </div>
</section>

<section class="our-journey py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" data-aos="fade-up">Our Journey</h2>
        <p class="text-muted mb-5" data-aos="fade-up" data-aos-delay="100">
            Salah satu dokumentasi perjalanan kami
        </p>

        @if($randomImage)
        <div class="gallery-card mx-auto shadow-lg rounded-4" style="max-width:600px; overflow:hidden;" data-aos="zoom-in">
            <img 
                src="{{ asset('images/paket/gallery/' . $randomImage->image) }}" 
                class="img-fluid w-100"
                style="height:400px; object-fit:cover; transition: transform 0.3s;"
                alt="{{ $randomImage->title ?? 'Gallery' }}"
                onmouseover="this.style.transform='scale(1.05)';" 
                onmouseout="this.style.transform='scale(1)';"
            >
            @if($randomImage->title)
            <div class="p-3 bg-white">
                <p class="mb-0 text-muted fw-medium">{{ $randomImage->title }}</p>
            </div>
            @endif
        </div>
        @else
        <p class="text-muted">Belum ada gambar gallery.</p>
        @endif
    </div>
</section>

<style>
    .about-hero {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 80px 0;
        position: relative;
    }

    .about-hero h1, .about-hero p {
        color: #fff;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }

    .our-journey h2 {
        font-size: 2.2rem;
    }

    .gallery-card img:hover {
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .about-hero {
            justify-content: center;
            text-align: center;
            padding: 60px 0;
        }

        .about-hero p {
            max-width: 90%;
            margin: 0 auto;
        }
    }
</style>
@endsection
