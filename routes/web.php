<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\VaksinasiController;
use App\Http\Controllers\VaccineController;

Route::get('/', function () {
    return view('welcome');
});

// Grup route untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil (bawaan Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menu Vaksin / Notifikasi Vaksinasi
    Route::get('/menu-vaksin', [VaksinasiController::class, 'index'])->name('menu-vaksin');
    Route::post('/menu-vaksin', [VaksinasiController::class, 'store'])->name('vaksinasi.store');
    Route::get('/vaksinasi/{id}', [VaksinasiController::class, 'show'])->name('vaksinasi.show');
    Route::patch('/vaksinasi/{id}/status', [VaksinasiController::class, 'updateStatus'])->name('vaksinasi.updateStatus');

    // Halaman Profil dan Riwayat
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');

    // Simpan vaksin dari pasien (jika ada penggunaan lain)
    Route::post('/vaksin', [VaccineController::class, 'store'])->name('vaksin.store');
});

require __DIR__.'/auth.php';
