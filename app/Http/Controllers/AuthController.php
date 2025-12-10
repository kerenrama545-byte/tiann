<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister()
{
    return view('auth.register');
}

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba autentikasi
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Jika admin → redirect ke admin home
         if ($user->is_admin) {
    return redirect()->route('admin.home');
}


            // User biasa → redirect home
            return redirect()->intended('/');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->withInput();
    }



    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false, // Default user biasa
        ]);

        // Auto login setelah register
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->is_admin) {
            return redirect('/admin/home')->with('success', 'Selamat datang Admin!');
        }

        return redirect('/')->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->name . '!');
    }



    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
        public function index()
    {
        // Logika untuk menampilkan dashboard admin ada di sini
        // Misalnya, mengambil statistik pengguna, pemesanan terbaru, dll.
        
        return view('admin.home');
    }

}
