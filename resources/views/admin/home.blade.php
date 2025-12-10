@extends('layouts.admin')

@section('title', 'Dashboard / Edit Hero')

@section('content')
<div class="container-fluid p-0">

    <!-- Top Bar -->
    <div class="admin-topbar mb-4">
        <button class="toggle-btn">
            <i class="bi bi-list"></i>
        </button>
        <div class="user-info">
            <img src="https://i.pravatar.cc/150?img=5" alt="Admin">
            <span>Admin User</span>
        </div>
    </div>

    <h1 class="h3 mb-4">Edit Hero Section</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form Hero Section -->
   <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">

@error('word1')
   <div class="text-danger">{{ $message }}</div>
@enderror


        @csrf
        @method('PUT')

        <!-- Judul Halaman -->
        <div class="mb-3">
            <label class="form-label">Judul Halaman</label>
            <input type="text" name="title" class="form-control"
                   value="{{ $hero->title ?? '' }}"
                   placeholder="Judul halaman">
        </div>

        <!-- Word1 -->
        <div class="mb-3">
            <label class="form-label">motto perusahaan 1</label>
            <input type="text" name="word1" class="form-control"
                   value="{{ $hero->word1 ?? '' }}"
                   placeholder="Contoh: Jelajahi">
        </div>

  

        <!-- Deskripsi -->
        <div class="mb-3">
            <label class="form-label">Deskripsi(di halaman about)</label>
            <textarea name="deskripsi" class="form-control" rows="3"
                      placeholder="Teks deskripsi hero">{{ $hero->deskripsi ?? '' }}</textarea>
        </div>

        <!-- Placeholder Search -->
        <div class="mb-3">
            <label class="form-label">Placeholder Search</label>
            <input type="text" name="search_placeholder" class="form-control"
                   value="{{ $hero->search_placeholder ?? '' }}"
                   placeholder="Cari destinasi impian Anda...">
        </div>

        <!-- Background Image -->
        <div class="mb-3">
            <label class="form-label">Background Hero</label>
            <input type="file" name="image" class="form-control" id="heroImageInput">

            @if(!empty($hero->image))
                <small>Gambar saat ini:</small>
                <div class="mt-2">
                    <img id="heroImagePreview"
                         src="{{ asset('images/hero/' . $hero->image) }}"
                         alt="Hero Image"
                         style="max-width:400px; border:1px solid #ddd; padding:5px;">
                </div>
            @else
                <div class="mt-2">
                    <img id="heroImagePreview"
                         src="#"
                         style="display:none; max-width:400px; border:1px solid #ddd; padding:5px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const heroImageInput = document.getElementById('heroImageInput');
    const heroImagePreview = document.getElementById('heroImagePreview');

    heroImageInput.addEventListener('change', function(){
        const file = this.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){
                heroImagePreview.src = e.target.result;
                heroImagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
