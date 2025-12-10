@extends('layouts.admin')

@section('title', 'Kelola Paket Wisata')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Daftar Paket Wisata</h4>
                    <a href="{{ route('admin.paket.create') }}" class="btn btn-light btn-sm">+ Tambah Paket Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Durasi</th>
                                    <th>Harga</th>
                                    <th>Featured</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pakets as $paket)
                                <tr>
                                    <td>
                                        @if($paket->image)
                                            <img src="{{ asset('images/paket/' . $paket->image) }}" alt="{{ $paket->name }}" width="60" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $paket->name }}</td>
                                    <td>{{ $paket->duration }} Hari</td>
                                    <td>Rp. {{ number_format($paket->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($paket->is_featured)
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- PERBAIKAN ADA DI SINI -->
                                        <a href="{{ route('admin.paket.edit', $paket->slug) }}" class="btn btn-sm btn-warning">Edit</a>
                                        
                                        <form action="{{ route('admin.paket.destroy', $paket->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data paket.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $pakets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection