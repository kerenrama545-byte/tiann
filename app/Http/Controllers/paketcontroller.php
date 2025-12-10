<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Gallery;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    // =============================
    // PUBLIC INDEX
    // =============================
    public function index()
    {
        $all_packages = Package::latest()->paginate(9);
        return view('packages.index', compact('all_packages'));
    }

    // =============================
    // PUBLIC SHOW (FIXED)
    // =============================
    public function show($slug)
    {
        $package = Package::with('galleries') // ← WAJIB
                          ->where('slug', $slug)
                          ->firstOrFail();

        $related_packages = Package::where('id', '!=', $package->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('paket.show', compact('package', 'related_packages'));
    }

    // =============================
    // ADMIN INDEX
    // =============================
    public function adminIndex()
    {
        $pakets = Package::latest()->paginate(10);
        return view('admin.paket', compact('pakets'));
    }

    // =============================
    // CREATE PAGE
    // =============================
    public function create()
    {
        return view('admin.paket_create');
    }

    // =============================
    // STORE
    // =============================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:packages,slug',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'is_featured' => 'sometimes|boolean',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Upload gambar utama
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/paket'), $imageName);
            $validated['image'] = $imageName;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $package = Package::create($validated);

        // =============================
        // GALERI (FIX)
        // =============================
        if ($request->hasFile('gallery')) {

            $path = public_path('images/paket/gallery');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            foreach ($request->file('gallery') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move($path, $fileName);

                Gallery::create([
                    'package_id' => $package->id,
                    'title' => null,
                    'image' => $fileName,
                ]);
            }
        }

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket wisata berhasil ditambahkan!');
    }

    // =============================
    // EDIT PAGE
    // =============================
    public function edit($slug)
    {
        $package = Package::with('galleries')->where('slug', $slug)->firstOrFail();
        return view('admin.paket_edit', compact('package'));
    }

    // =============================
    // UPDATE
    // =============================
    public function update(Request $request, $slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:packages,slug,' . $package->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'is_featured' => 'sometimes|boolean',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Replace image
        if ($request->hasFile('image')) {

            if ($package->image && file_exists(public_path('images/paket/'.$package->image))) {
                unlink(public_path('images/paket/'.$package->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/paket'), $imageName);
            $validated['image'] = $imageName;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $package->update($validated);

        // Tambah galeri baru saat edit
        if ($request->hasFile('gallery')) {

            $path = public_path('images/paket/gallery');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            foreach ($request->file('gallery') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move($path, $fileName);

                Gallery::create([
                    'package_id' => $package->id,
                    'title' => null,
                    'image' => $fileName,
                ]);
            }
        }

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket wisata "' . $package->name . '" berhasil diperbarui!');
    }

    // =============================
    // DELETE (FIXED)
    // =============================
    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        // Hapus foto utama
        if ($package->image && file_exists(public_path('images/paket/'.$package->image))) {
            unlink(public_path('images/paket/'.$package->image));
        }

        // FIX: nama relasi adalah "galleries"
        foreach ($package->galleries as $g) {
            if (file_exists(public_path('images/paket/gallery/'.$g->image))) {
                unlink(public_path('images/paket/gallery/'.$g->image));
            }
            $g->delete();
        }

        $package->delete();

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket wisata berhasil dihapus!');
    }
}
