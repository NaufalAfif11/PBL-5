<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Vaksin\MenuVaksinController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VaccineController;
use App\Models\Notification;

Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menu vaksin
    Route::get('/menu-vaksin', [MenuVaksinController::class, 'index'])->name('menu-vaksin');

    // Profil, Riwayat, Notifikasi
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');

    // Dashboard pasien
    Route::get('/dashboard', function () {
        $notifications = Notification::where('user_id', auth()->id())->get();
        return view('dashboard', compact('notifications'));
    })->name('dashboard');

    // Notifikasi khusus dokter (view ada di resources/views/dokter/notifikasi.blade.php)
    Route::get('/dokter/notifikasi', function () {
    return view('dokter.notifikasi');
})->name('notifikasi')->middleware('auth');

Route::get('/dokter/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');


    // Dashboard masing-masing role
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/dokter', function () {
        $notifications = Notification::all(); // Sesuaikan jika hanya milik dokter
        return view('dokter.dashboard', compact('notifications'));
    })->name('dokter.dashboard');

    Route::get('/pasien', function () {
        $notifications = Notification::where('user_id', auth()->id())->get();
        return view('dashboard', compact('notifications')); // Atau view pasien khusus
    })->name('pasien.dashboard');
});

// Post vaksin (dari form)
Route::post('/vaksin', [VaccineController::class, 'store'])->name('vaksin.store');

// Optional: route fallback
require __DIR__ . '/auth.php';
