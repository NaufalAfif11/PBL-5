<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
{
    $userEmail = auth()->user()->email;
    $role = auth()->user()->role;

    $riwayat = \App\Models\Vaksinasi::where('status', '!=', 'Belum')
        ->when($role === 'pasien', fn($q) => $q->where('patient_email', $userEmail))
        ->when($role === 'dokter', fn($q) => $q->where('doctor_email', $userEmail))
        ->get();

    return view('riwayat', compact('riwayat'));
}

}
