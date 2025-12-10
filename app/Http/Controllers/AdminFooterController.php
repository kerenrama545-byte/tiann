<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Footer; // pastikan ada model Footer

class AdminFooterController extends Controller
{
    // Menampilkan form pengaturan footer
    public function edit()
    {
        $footer = Footer::first(); // ambil data footer pertama
        return view('admin.pengaturan', compact('footer'));
    }

    // Update data footer
    public function update(Request $request)
    {
        $footer = Footer::first() ?? new Footer;

        $footer->email = $request->email;
        $footer->whatsapp = $request->whatsapp;
        $footer->instagram = $request->instagram;
        $footer->facebook = $request->facebook;
        $footer->save();

        return redirect()->route('admin.footer.edit')->with('success', 'Footer berhasil diperbarui.');
    }
}
