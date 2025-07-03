<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaksinasi;
use Illuminate\Support\Facades\Auth;

class VaksinasiController extends Controller
{
    /**
     * Menampilkan daftar vaksinasi yang statusnya "Belum"
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil hanya data dengan status 'Belum' sesuai role
        if ($user->role === 'dokter') {
            $data = Vaksinasi::where('status', 'Belum')
                ->where('doctor_email', $user->email)
                ->orderBy('vaccine_date')
                ->get();
        } else {
            $data = Vaksinasi::where('status', 'Belum')
                ->where('patient_email', $user->email)
                ->orderBy('vaccine_date')
                ->get();
        }

        return view('menu-vaksin', compact('data'));
    }

    /**
     * Menyimpan data vaksinasi baru (oleh pasien)
     */
    public function store(Request $request)
    {
        $request->validate([
            'vaccine_name' => 'required|string',
            'doctor_name'  => 'required|string',
            'vaccine_date' => 'required|date',
            'address'      => 'required|string',
        ]);

        [$doctor_name, $doctor_email] = explode('|', $request->doctor_name);

        Vaksinasi::create([
            'vaccine_name'   => $request->vaccine_name,
            'vaccine_date'   => $request->vaccine_date,
            'address'        => $request->address,
            'doctor_name'    => $doctor_name,
            'doctor_email'   => $doctor_email,
            'patient_email'  => Auth::user()->email,
            'status'         => 'Belum',
        ]);

        return redirect()->route('menu-vaksin')->with('success', 'Jadwal vaksinasi berhasil ditambahkan.');
    }

    /**
     * Mengubah status vaksinasi menjadi "Sudah" atau "Dibatalkan"
     */
    public function updateStatus(Request $request, $id)
    {
        $vaksin = Vaksinasi::findOrFail($id);
        $request->validate([
            'status' => 'in:Sudah,Dibatalkan'
        ]);

        $vaksin->status = $request->status;
        $vaksin->save();

        return redirect()->route('menu-vaksin')->with('success', 'Status vaksinasi diperbarui.');
    }

    /**
     * Menampilkan detail data vaksinasi (dipanggil lewat fetch JS)
     */
    public function show($id)
    {
        $data = Vaksinasi::findOrFail($id);
        return response()->json($data);
    }
}
