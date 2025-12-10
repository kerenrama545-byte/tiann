@extends('layouts.admin')

@section('title', 'Pengaturan Footer')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Pengaturan Footer</h4>
                </div>

                <div class="card-body">

                    {{-- SUCCESS MESSAGE --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ route('admin.footer.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                name="email" 
                                value="{{ old('email', $footer->email ?? '') }}"
                            >
                        </div>

                        {{-- WHATSAPP --}}
                        <div class="mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="whatsapp" 
                                value="{{ old('whatsapp', $footer->whatsapp ?? '') }}"
                            >
                        </div>

                        {{-- INSTAGRAM --}}
                        <div class="mb-3">
                            <label class="form-label">Instagram Username</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="instagram" 
                                value="{{ old('instagram', $footer->instagram ?? '') }}"
                            >
                        </div>

                        {{-- FACEBOOK --}}
                        <div class="mb-3">
                            <label class="form-label">Facebook Username</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="facebook" 
                                value="{{ old('facebook', $footer->facebook ?? '') }}"
                            >
                        </div>

                        <div class="d-flex justify-content-between">

                            {{-- SAFE BACK BUTTON (NO ROUTE NEEDED) --}}
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>

                            {{-- SAVE --}}
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
