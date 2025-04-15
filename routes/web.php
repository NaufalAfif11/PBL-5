<?php

// routes/web.php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('welcome'); // atau view lain seperti 'login' jika kamu ubah
});

Route::get('/menu-vaksin', [VaksinController::class, 'index'])->name('menu.vaksin');

Route::get('/profil', [UserController::class, 'profil'])->name('profil');

Route::get('/profil', [UserController::class, 'profil'])->name('profil');

Route::get('/register', function () {
    return view('auth.register'); // sesuaikan juga
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Demo Frontend
Route::view('/register', 'auth.register')->name('register');
Route::view('/login', 'auth.login')->name('login');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/menu-vaksin', 'menu-vaksin')->name('menu-vaksin');
Route::view('/profil', 'profil')->name('profil');
Route::view('/notifikasi', 'notifikasi')->name('notifikasi');
Route::view('/riwayat', 'riwayat')->name('riwayat');


require __DIR__.'/auth.php';