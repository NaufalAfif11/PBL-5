<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\VaksinasiController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Grup route untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // ================= ADMIN ====================
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/jadwal', [AdminController::class, 'kelolaJadwal'])->name('jadwal');
    Route::post('/jadwal', [AdminController::class, 'storeJadwal'])->name('jadwal.store');
    Route::get('/vaksin', [AdminController::class, 'kelolaVaksin'])->name('vaksin');
    Route::get('/assign', [AdminController::class, 'assignVaccine'])->name('assign');
    Route::post('/assign', [AdminController::class, 'storeVaksin'])->name('assign.store');
});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::patch('/jadwal/{id}/update', [AdminController::class, 'updateJadwal'])->name('jadwal.update');
});
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/vaksin/store', [AdminController::class, 'storeVaksin'])->name('vaksin.store');
    Route::patch('/admin/jadwal/{id}', [AdminController::class, 'updateJadwal'])->name('admin.jadwal.update');

});

    // ================ USER ===============
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Timeline
    Route::get('/timeline/{id}', [TimelineController::class, 'show']);

    // Profil bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Halaman Profil dan Riwayat
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::get('/vaksinasi/{id}', [RiwayatController::class, 'show']); // modal detail

    // Menu Vaksin / Notifikasi
    Route::get('/menu-vaksin', [VaksinasiController::class, 'index'])->name('menu-vaksin');
    Route::post('/menu-vaksin', [VaksinasiController::class, 'store'])->name('vaksinasi.store');
    Route::patch('/vaksinasi/{id}/status', [VaksinasiController::class, 'updateStatus'])->name('vaksinasi.updateStatus');

    // Tambah vaksin manual
    Route::post('/vaksin', [VaccineController::class, 'store'])->name('vaksin.store');
});

require __DIR__.'/auth.php';
