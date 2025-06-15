<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller // Added class declaration
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all vaccine records from the database
        $vaccines = Vaccine::all();
        // Return the 'menu-vaksin' view, passing the retrieved vaccine data
        return view('menu-vaksin', compact('vaccines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        // 'vaccine_name', 'doctor_name', 'vaccine_date', 'patient_address' are required.
        // 'vaccine_date' must be a valid date format.
        $request->validate([
            'vaccine_name' => 'required|string|max:255', // Added string and max length validation
            'doctor_name' => 'required|string|max:255',  // Added string and max length validation
            'vaccine_date' => 'required|date',
            'patient_address' => 'required|string|max:255', // Added string and max length validation
        ]);

        // Create a new Vaccine record using the validated request data
        Vaccine::create($request->all());

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Data vaksin berhasil ditambahkan!');
    }
}
