<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Gallery;

class AboutController extends Controller
{
    public function index()
    {
        $hero = Hero::first();               // ambil data hero
        $randomImage = Gallery::inRandomOrder()->first(); // ambil gambar acak dari galleries

        return view('about', compact('hero', 'randomImage'));
    }
}
