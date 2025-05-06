<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Vaksin\MenuVaksinController;
use App\Http\Controllers\ProfilController; // <== tambahkan ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/menu-vaksin', [MenuVaksinController::class, 'index'])->name('menu-vaksin');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
});

require __DIR__.'/auth.php';
