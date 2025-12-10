@extends('layouts.app')

@section('title', 'Gallery')

@section('content')

<style>
    .gallery-card {
        height: 320px;                 /* semua card tinggi sama */
        overflow: hidden;
        border-radius: 20px;
    }

    .gallery-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;             /* biar gambar nutup full tanpa white space */
    }
</style>

<div class="container py-5">
    <h1 class="mb-4 text-center">Gallery</h1>

    <div class="row g-4">
        @foreach ($gallery as $g)
        <div class="col-md-4">
            <div class="gallery-card shadow-sm">
                <img src="{{ asset('images/paket/gallery/' . $g->image) }}" alt="">
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
