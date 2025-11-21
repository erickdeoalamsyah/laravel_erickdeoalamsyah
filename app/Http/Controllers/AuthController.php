<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller sederhana untuk login/logout menggunakan username.
 */
class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('rumah-sakit.index');
        }

        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        // Validasi input basic
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Auth::attempt otomatis cek password hash di DB
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // proteksi session fixation

            return redirect()->intended(route('rumah-sakit.index'));
        }

        // Jika gagal
        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->onlyInput('username');
    }

    /**
     * Logout dan destroy session.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
