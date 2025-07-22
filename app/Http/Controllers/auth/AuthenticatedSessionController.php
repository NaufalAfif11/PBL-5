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
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    $request->session()->regenerate();

    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect('/admin');
    } elseif ($role === 'dokter') {
        return redirect('/dashboard');
    } else {
        return redirect('/dashboard');
    }
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
