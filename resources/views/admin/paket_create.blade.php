@extends('layouts.admin')

@section('title', 'Tambah Paket Wisata Baru')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Paket Wisata Baru</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.paket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>
                                    @error('slug') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Durasi (Hari)</label>
                                    <input type="number" class="form-control" name="duration" min="1" value="{{ old('duration') }}" required>
                                    @error('duration') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="price" min="0" value="{{ old('price') }}" required>
                                    @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Utama</label>
                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                    @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- ✅ GALERI SUDAH DIPINDAH KE DALAM FORM -->
                        <div class="mb-3">
                            <label class="form-label">Galeri Foto (bisa pilih lebih dari satu)</label>
                            <input type="file" class="form-control" name="gallery[]" accept="image/*" multiple>
                            <small class="text-muted">Upload beberapa gambar untuk galeri paket wisata.</small>

                            @error('gallery') <div class="text-danger small">{{ $message }}</div> @enderror
                            @error('gallery.*') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3 form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label">Tampilkan di Halaman Utama (Featured)</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan Paket Baru</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
