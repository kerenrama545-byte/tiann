@extends('../layouts.app')

@section('title', 'Jelajahi Tempat Wisata')

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h1 class="section-title">Jelajahi Tempat Wisata</h1>
            <p class="section-subtitle">Temukan destinasi impian Anda di berbagai penjuru Indonesia</p>
        </div>

        <div class="row g-4">
            @foreach ($places as $place)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="custom-card">
                    <img src="{{ $place['image'] }}" class="card-img-top" alt="{{ $place['name'] }}">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">{{ $place['category'] }}</span>
                        <h5 class="card-title">{{ $place['name'] }}</h5>
                        <p class="card-text text-muted"><i class="bi bi-geo-alt"></i> {{ $place['location'] }}</p>
                        <p class="card-text">{{ Str::limit($place['short_description'], 80) }}</p>
                        <a href="{{ route('places.show', $place['slug']) }}" class="btn btn-outline-primary w-100 mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection