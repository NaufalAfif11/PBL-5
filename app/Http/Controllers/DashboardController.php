<?php

namespace App\Http\Controllers;

use App\Models\Vaksinasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $query = Vaksinasi::where('status', 'Belum');

        if ($user->role === 'pasien') {
            $query->where('patient_email', $user->email);
        } elseif ($user->role === 'dokter') {
            $query->where('doctor_email', $user->email); // hanya data pasien dokter tsb
        }

        $timeline = $query->orderBy('vaccine_date')->get();

        return view('dashboard', compact('timeline'));
    }
}
