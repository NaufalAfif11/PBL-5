<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Timeline::query();

        if ($user->role === 'pasien') {
            $query->where('patient_email', $user->email);
        } elseif ($user->role === 'dokter') {
            $query->where('doctor_email', $user->email);
        }

        $timeline = $query->orderBy('vaccine_date')->get();

        return view('dashboard', compact('timeline'));
    }

    public function show($id)
    {
        $timeline = Timeline::findOrFail($id);
        return response()->json($timeline);
    }
}

