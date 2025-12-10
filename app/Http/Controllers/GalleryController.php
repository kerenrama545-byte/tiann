<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // =====================
    // HALAMAN GALLERY
    // =====================
    public function index()
    {
        // Load semua foto gallery
        $gallery = Gallery::all();

        // Tampilkan view gallery.blade.php
        return view('gallery', compact('gallery'));
    }

    // =====================
    // SIMPAN FOTO GALLERY
    // =====================
    public function store(Request $request, $package_id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:4096'
        ]);

        $path = public_path('images/paket/gallery');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->move($path, $fileName);

        Gallery::create([
            'package_id' => $package_id,
            'title' => $request->title,
            'image' => $fileName,
        ]);

        return back()->with('success', 'Foto galeri berhasil ditambahkan.');
    }
}
