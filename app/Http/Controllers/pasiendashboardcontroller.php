<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienDashboardController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan dashboard pasien
        return view('dashboard'); // Contoh view
    }
}