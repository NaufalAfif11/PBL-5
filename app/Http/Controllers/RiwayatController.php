<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaksinasi;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Vaksinasi::where('status', '!=', 'Belum');

        // Filter berdasarkan role user
        if ($user->role === 'pasien') {
            $query->where('patient_email', $user->email);
        } elseif ($user->role === 'dokter') {
            $query->where('doctor_email', $user->email);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vaccine_name', 'like', "%{$search}%")
                  ->orWhere('doctor_name', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $riwayat = $query->latest()->get();

        return view('riwayat', compact('riwayat'));
    }

    public function show($id)
    {
        $riwayat = Vaksinasi::findOrFail($id);
        return response()->json($riwayat);
    }
}
