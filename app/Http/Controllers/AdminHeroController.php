<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class AdminHeroController extends Controller
{
    public function edit()
    {
        $hero = Hero::first();

return view('admin.home', compact('hero'));

    }

   public function update(Request $request)
{
    // Ambil data hero pertama, atau buat baru dengan id 1
    $hero = Hero::firstOrNew(['id' => 1]);

    // Validasi lebih fleksibel (tidak pakai required)
    $request->validate([
        'title' => 'nullable|string|max:255',
        'word1' => 'nullable|string|max:255',
        'word2' => 'nullable|string|max:255',
        'word3' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
        'search_placeholder' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Upload gambar
    if ($request->hasFile('image')) {

        if ($hero->image && file_exists(public_path('images/hero/' . $hero->image))) {
            unlink(public_path('images/hero/' . $hero->image));
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/hero'), $imageName);

        $hero->image = $imageName;
    }

    // Hanya update field yang ada di request
    $hero->fill(array_filter($request->only([
        'title',
        'word1',
        'word2',
        'word3',
        'deskripsi',
        'search_placeholder',
    ])));

    $hero->save();

    return redirect()->route('admin.home')
        ->with('success', 'Hero Section berhasil diperbarui!');
}

}
