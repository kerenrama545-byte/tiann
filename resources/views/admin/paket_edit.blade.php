@extends('layouts.admin')

@section('title', 'Edit Paket - ' . $package->name)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Paket Wisata</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.paket.update', $package->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $package->name) }}" required>
                                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug', $package->slug) }}" required>
                                    @error('slug') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ old('description', $package->description) }}</textarea>
                            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Durasi (Hari)</label>
                                    <input type="number" class="form-control" name="duration" min="1" value="{{ old('duration', $package->duration) }}" required>
                                    @error('duration') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="price" min="0" value="{{ old('price', $package->price) }}" required>
                                    @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Utama</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                    @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        @if($package->image)
                        <div class="mb-3">
                            <small class="text-muted">Gambar saat ini:</small><br>
                            <img src="{{ asset('images/paket/' . $package->image) }}" class="img-thumbnail mt-1" style="max-height: 120px;">
                        </div>
                        @endif

                        <!-- GALERI -->
                        <div class="mb-3">
                            <label class="form-label">Galeri Foto (bisa pilih lebih dari satu)</label>
                            <input type="file" class="form-control" name="gallery[]" accept="image/*" multiple>
                            <small class="text-muted">Upload beberapa gambar baru untuk galeri.</small>

                            @error('gallery') <div class="text-danger small">{{ $message }}</div> @enderror
                            @error('gallery.*') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        @if($package->gallery && count($package->gallery))
                        <div class="mb-3">
                            <label class="form-label">Galeri Saat Ini:</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($package->gallery as $item)
                                    <div class="text-center">
                                        <img src="{{ asset('images/paket/gallery/' . $item->image) }}" 
                                             class="img-thumbnail mb-1" style="max-height: 100px;">
                                        <div>
                                            <input type="checkbox" name="delete_gallery[]" value="{{ $item->id }}">
                                            <small>Hapus</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="mb-3 form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="is_featured" value="1"
                                {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label">Tampilkan di Halaman Utama (Featured)</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
