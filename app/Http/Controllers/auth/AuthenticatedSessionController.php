<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // Pastikan ini ada

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan tampilan login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan otentikasi yang masuk.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input email dan password
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Coba untuk mengotentikasi pengguna
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Jika otentikasi gagal, lempar pengecualian validasi
            throw ValidationException::withMessages([
                'email' => __('auth.failed'), // Pesan kesalahan dari file bahasa
            ]);
        }

        // Regenerasi sesi untuk mencegah fiksasi sesi
        $request->session()->regenerate();

        // Dapatkan pengguna yang baru saja diotentikasi
        $user = Auth::user();

        // Redirect berdasarkan peran (role) pengguna
        if ($user->role === 'admin') {
            // Jika peran adalah 'admin', arahkan ke dashboard admin
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'doctor') {
            // Contoh: Jika peran adalah 'doctor', arahkan ke dashboard dokter
            return redirect()->route('doctor.dashboard');
        }
        // Tambahkan kondisi lain untuk peran lain jika diperlukan

        // Default: Jika tidak ada peran khusus yang cocok, arahkan ke halaman utama
        return redirect()->intended('/');
    }

    /**
     * Menghancurkan sesi terotentikasi.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout pengguna dari guard 'web'
        Auth::guard('web')->logout();

        // Batalkan sesi pengguna
        $request->session()->invalidate();

        // Regenerasi token CSRF sesi
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman utama atau halaman login
        return redirect('/');
    }
}
