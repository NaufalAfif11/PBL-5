<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Vaksin\MenuVaksinController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    // Halaman profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Halaman umum
    Route::get('/menu-vaksin', [MenuVaksinController::class, 'index'])->name('menu-vaksin');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');

    // Dashboard berdasarkan peran
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/dokter/dashboard', function () {
        return view('dashboard.dokter');
    })->middleware('role:dokter')->name('dokter.dashboard');

    Route::get('/pasien/dashboard', function () {
        return view('dashboard.pasien');
    })->middleware('role:pasien')->name('pasien.dashboard');
});

require __DIR__.'/auth.php';
