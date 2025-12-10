@extends('layouts.app')

@section('title', 'Semua Paket Wisata - TravelKu')

@section('content')

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Semua Paket Wisata</h2>
            <p class="section-subtitle">Temukan semua paket wisata pilihan kami</p>
        </div>

        <div class="row g-4">
            @forelse($all_packages as $package)
            <div class="col-lg-4 col-md-6">
                <div class="package-modern d-flex flex-column h-100">
                    <div class="img-wrapper mb-3">
                        <img src="{{ asset('images/paket/' . data_get($package,'image','default.jpg')) }}" alt="{{ $package->name }}" style="width:100%; height:230px; object-fit:cover; border-radius:18px;">
                        <span class="badge-days">{{ $package->duration }} Hari</span>
                    </div>

                    <div class="package-body flex-grow-1 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="fw-bold">{{ $package->name }}</h5>
                            <p class="text-muted">{{ Str::limit($package->description, 85) }}</p>
                        </div>

                        <div class="package-footer d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <div class="small text-muted">Mulai dari</div>
                                <div class="fw-bold price-modern">Rp {{ number_format($package->price,0,',','.') }}</div>
                            </div>
                            <a href="{{ route('paket.show', $package->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center">Belum ada paket wisata tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

<style>
/* Pastikan semua package-modern memiliki tinggi konsisten */
.package-modern {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.package-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>

@endsection
