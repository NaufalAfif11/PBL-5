<?php

namespace App\Http\Controllers;

use App\Models\Vaksinasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Availability;

class DashboardController extends Controller
{
    public function index(): View
{
    $user = Auth::user();

    // Ambil timeline sesuai role
    $query = Vaksinasi::where('status', '!=', '');

    if ($user->role === 'pasien') {
        $query->where('patient_email', $user->email);
    } elseif ($user->role === 'dokter') {
        $query->where('doctor_email', $user->email);
    }

    $timeline = $query->get(); // hasil akhir dari query sesuai role

    // Ambil jadwal dokter untuk admin
    $jadwalDokter = [];
    if ($user->role === 'admin') {
        $jadwalDokter = Availability::with('doctor')->get();
    }

    return view('dashboard', compact('timeline', 'jadwalDokter'));
}

}
