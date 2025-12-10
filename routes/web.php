<?php

use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AdminHeroController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminFooterController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Paket Wisata

Route::get('/paket/{slug}', [PaketController::class, 'show'])->name('paket.show');


// Tempat Wisata
Route::get('/tempat-wisata', [PlaceController::class, 'index'])->name('places.index');
Route::get('/tempat-wisata/{slug}', [PlaceController::class, 'show'])->name('places.show');

// Halaman Statis

Route::view('/kontak', 'contact')->name('contact');
use App\Http\Controllers\AboutController;

Route::get('/about', [AboutController::class, 'index'])->name('about');


// Booking
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return view('admin.home');
})->name('dashboard');


Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/packages', [HomeController::class, 'indexPackages'])->name('packages.index');



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard Admin
        Route::get('/home', function () {
            return view('admin.home');
        })->name('home');

        // Pengaturan Footer
        Route::get('/pengaturan', [AdminFooterController::class, 'edit'])->name('footer.edit');
        Route::put('/pengaturan', [AdminFooterController::class, 'update'])->name('footer.update');

        // Hero Section
        Route::get('/hero', [AdminHeroController::class, 'edit'])->name('hero.edit');
        Route::put('/hero', [AdminHeroController::class, 'update'])->name('hero.update');

        // Paket Wisata (Admin)
        Route::get('/paket', [PaketController::class, 'adminIndex'])->name('paket.index');
        Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
        Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
        Route::get('/paket/{slug}/edit', [PaketController::class, 'edit'])->name('paket.edit');
        Route::put('/paket/{slug}', [PaketController::class, 'update'])->name('paket.update');
        Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');

        // Gallery Paket
        Route::post('/paket/{id}/gallery', [GalleryController::class, 'store'])->name('paket.gallery.store');

        // Tempat Wisata (Admin)
        Route::get('/tempat-wisata', [PlaceController::class, 'index'])->name('places.index');

        // Pemesanan
        Route::get('/pemesanan', [BookingController::class, 'index'])->name('bookings.index');

        // Pengguna
        Route::get('/pengguna', [UserController::class, 'index'])->name('users.index');

        // Testimoni
        Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimonials.index');
});
