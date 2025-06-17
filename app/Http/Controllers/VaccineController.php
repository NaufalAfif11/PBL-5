<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function index()
{
    $vaccines = Vaccine::all();
    return view('menu-vaksin', compact('vaccines'));
}


    public function store(Request $request)
    {
        $request->validate([
            'vaccine_name' => 'required|string|max:255',
            'vaccine_date' => 'required|date',
            'doctor_name' => 'required|string|max:255',
        ]);

        Vaccine::create([
            'vaccine_name' => $request->vaccine_name,
            'vaccine_date' => $request->vaccine_date,
            'doctor_name' => $request->doctor_name,
        ]);

        return response()->json(['message' => 'Vaksin berhasil ditambahkan']);
    }
}
