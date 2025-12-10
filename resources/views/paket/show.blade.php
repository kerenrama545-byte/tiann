@extends('layouts.app')

@section('title', $package->name . ' - TravelKu')

@section('content')

<!-- HERO -->
<section class="package-hero position-relative" style="background-image: url('{{ asset('images/paket/' . $package->image) }}');">
    <div class="hero-overlay"></div>
    <div class="container position-relative">
        <div class="package-hero-content">
            <div class="hero-badges mb-3" data-aos="fade-up">
                <span class="badge badge-primary me-2"><i class="bi bi-star-fill"></i> Populer</span>
                <span class="badge badge-secondary"><i class="bi bi-award"></i> Terbaik</span>
            </div>
            <h1 data-aos="fade-up">{{ $package->name }}</h1>
            <div class="package-meta mt-3" data-aos="fade-up" data-aos-delay="100">
                <span class="meta-item"><i class="bi bi-clock-fill"></i> {{ $package->duration }} Hari</span>
                <span class="meta-item"><i class="bi bi-geo-alt-fill"></i> Indonesia</span>
                <span class="meta-item"><i class="bi bi-people-fill"></i> Minimal 2 Orang</span>
            </div>
        </div>
    </div>
    <div class="scroll-indicator">
        <i class="bi bi-chevron-double-down"></i>
    </div>
</section>

<!-- QUICK INFO BAR -->
<section class="quick-info-bar sticky-top bg-white shadow-sm py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex flex-wrap align-items-center">
            <div class="info-item me-4"><i class="bi bi-calendar-check text-primary"></i> Pilih Tanggal</div>
            <div class="info-item me-4"><i class="bi bi-people text-primary"></i> Jumlah Peserta</div>
            <div class="info-item"><i class="bi bi-tag text-primary"></i> Harga Mulai</div>
        </div>
        <button class="btn btn-primary rounded-pill px-4" onclick="scrollToBooking()">
            <i class="bi bi-cart-plus me-2"></i>Pesan Sekarang
        </button>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="section-padding">
    <div class="container">
        <div class="row">

            <!-- LEFT CONTENT -->
            <div class="col-lg-8">

                <!-- IMAGE LARGE -->
                <div class="package-image-large mb-4 position-relative" data-aos="fade-up">
                    <img src="{{ asset('images/paket/' . $package->image) }}"
                         class="img-fluid rounded-4 shadow-sm main-package-image"
                         alt="{{ $package->name }}"
                         data-bs-toggle="modal"
                         data-bs-target="#imageModal"
                         data-image="{{ asset('images/paket/' . $package->image) }}">
                    <div class="image-overlay">
                        <button class="btn btn-light rounded-circle zoom-btn">
                            <i class="bi bi-zoom-in"></i>
                        </button>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="package-description mb-5" data-aos="fade-up" data-aos-delay="150">
                    <h4 class="mb-3">Deskripsi Paket</h4>
                    <div class="description-content">
                        {!! $package->description !!}
                    </div>
                    <button class="btn btn-link p-0 read-more-btn" onclick="toggleDescription()">
                        <span id="readMoreText">Baca Selengkapnya</span>
                        <i class="bi bi-chevron-down" id="readMoreIcon"></i>
                    </button>
                </div>

                

                <!-- GALLERY -->
                @if ($package->galleries->count())
                <div class="package-gallery mb-5" data-aos="fade-up" data-aos-delay="250">
                    <h4 class="mb-4">Galeri Foto</h4>
                    <div class="row g-3">
                        @foreach ($package->galleries as $img)
                        <div class="col-12 col-md-4">
                            <div class="gallery-item position-relative">
                                <img src="{{ asset('images/paket/gallery/' . $img->image) }}"
                                     class="img-fluid rounded-3 gallery-image"
                                     alt="Galeri {{ $package->name }}"
                                     data-bs-toggle="modal"
                                     data-bs-target="#imageModal"
                                     data-image="{{ asset('images/paket/gallery/' . $img->image) }}">
                                <div class="gallery-overlay">
                                    <i class="bi bi-zoom-in"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <!-- RIGHT – BOOKING CARD -->
            <div class="col-lg-4">
                <div class="booking-card position-sticky" id="bookingCard" data-aos="fade-up" data-aos-delay="150">
                    <div class="booking-header position-relative">
                        <div class="booking-badge">Best Price</div>
                        <h3 class="booking-title">{{ $package->name }}</h3>
                        <div class="booking-price">
                            <span class="price-label">Mulai dari</span>
                            <div class="price-container">
                                <span class="price-value">Rp. {{ number_format($package->price, 0, ',', '.') }}</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>
                    </div>
                    <div class="booking-body p-4">
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control" name="departure_date">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Peserta</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseParticipants()">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" class="form-control text-center" name="participants" value="2" min="1" max="10" id="participantsCount">
                                    <button class="btn btn-outline-secondary" type="button" onclick="increaseParticipants()">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold">
                                <i class="bi bi-cart-plus me-2"></i>Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- RELATED PACKAGES -->
@if ($related_packages->isNotEmpty())
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Paket Lainnya</h2>
        </div>
        <div class="row g-4">
            @foreach ($related_packages as $related)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="package-card h-100">
                    <div class="package-image position-relative">
                        <img src="{{ asset('images/paket/' . $related->image) }}" class="img-fluid" alt="{{ $related->name }}">
                        <div class="package-overlay"></div>
                        <div class="package-badge">{{ $related->duration }} Hari</div>
                        <div class="package-action">
                            <a href="{{ route('paket.show', $related->slug) }}" class="btn btn-light btn-sm">
                                <i class="bi bi-eye me-1"></i>Lihat
                            </a>
                        </div>
                    </div>
                    <div class="package-content p-4">
                        <h5 class="package-title">{{ $related->name }}</h5>
                        <p class="package-description">{{ Str::limit(strip_tags($related->description), 90) }}</p>
                        <div class="package-footer d-flex justify-content-between align-items-center mt-3">
                            <span class="price-value">Rp. {{ number_format($related->price, 0, ',', '.') }}</span>
                            <a href="{{ route('paket.show', $related->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- IMAGE MODAL -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 text-white" data-bs-dismiss="modal"></button>
                <img id="modalImage" src="" class="img-fluid" alt="Gallery Image">
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Image Modal
document.querySelectorAll('.gallery-image, .main-package-image').forEach(img => {
    img.addEventListener('click', function() {
        document.getElementById('modalImage').src = this.dataset.image;
    });
});

// Toggle Description
function toggleDescription() {
    const desc = document.querySelector('.description-content');
    const text = document.getElementById('readMoreText');
    const icon = document.getElementById('readMoreIcon');
    desc.classList.toggle('expanded');
    if(desc.classList.contains('expanded')){
        text.textContent = 'Sembunyikan';
        icon.className = 'bi bi-chevron-up';
    } else {
        text.textContent = 'Baca Selengkapnya';
        icon.className = 'bi bi-chevron-down';
    }
}

// Participant Counter
function increaseParticipants() {
    const input = document.getElementById('participantsCount');
    if(input.value < 10) input.value = parseInt(input.value)+1;
}
function decreaseParticipants() {
    const input = document.getElementById('participantsCount');
    if(input.value > 1) input.value = parseInt(input.value)-1;
}

// Scroll to Booking
function scrollToBooking() {
    document.getElementById('bookingCard').scrollIntoView({ behavior: 'smooth', block: 'center' });
}
</script>
@endpush
