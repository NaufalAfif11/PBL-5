<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Pastikan model Notification sudah ada

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data notifikasi vaksin dari database
        $notifications = Notification::orderBy('vaccine_date')->get();

        // Kirim data ke view dashboard
        return view('dashboard', compact('notifications'));
    }
}
