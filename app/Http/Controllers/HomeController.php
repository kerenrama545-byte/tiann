<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import semua model
use App\Models\Hero;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\Footer;

class HomeController extends Controller
{
    // Halaman paket lengkap (lihat semua paket)
    public function indexPackages()
    {
        $all_packages = Package::latest()->get();
        return view('paket', compact('all_packages'));
    }

    // Halaman home
    public function index()
    {
        // Ambil hero
        $hero = Hero::first();

        // Ambil 6 paket terbaru untuk tampil di home
        $all_packages = Package::latest()->take(6)->get();

        // Ambil paket featured untuk Destinasi Utama
        $top_destinations = Package::where('is_featured', 1)->latest()->take(6)->get();

        // Ambil fitur & footer
        $features = Feature::orderBy('order')->get();
        $footer = Footer::first();

        return view('home', compact(
            'hero',
            'all_packages',
            'top_destinations',
            'features',
            'footer'
        ));
    }
}
