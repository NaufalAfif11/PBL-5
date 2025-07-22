<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaksinasi;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;

class VaksinasiController extends Controller
{
    /**
     * Menampilkan daftar vaksinasi sesuai peran user
     */
    public function index()
{
    $user = Auth::user();
    $data = [];
    $jadwal = []; // ✅ Tambahkan inisialisasi awal

    if ($user->role === 'dokter') {
        $data = Vaksinasi::where('status', 'Belum')
            ->where('doctor_email', $user->email)
            ->orderBy('vaccine_date')
            ->get();
    } elseif ($user->role === 'pasien') {
        $data = Vaksinasi::where('status', 'Belum')
            ->where('patient_email', $user->email)
            ->orderBy('vaccine_date')
            ->get();
    } elseif ($user->role === 'admin') {
        $data = Vaksinasi::where('status', 'Belum')
            ->orderBy('vaccine_date')
            ->get();

        // ✅ Ambil jadwal dokter hanya untuk admin
        $jadwal = Availability::with('doctor')->orderBy('hari')->get();
    }

    // Semua jadwal untuk keperluan JavaScript
    $semua_jadwal = Availability::with('doctor')->get();

    return view('menu-vaksin', compact('data', 'jadwal', 'semua_jadwal'));
}


    /**
     * Menyimpan data vaksinasi baru oleh pasien
     */
    public function store(Request $request)
    {
        $request->validate([
            'vaccine_name'  => 'required|string',
            'vaccine_date'  => 'required|date',
            'vaccine_time'  => 'required',
            'address'       => 'required|string',
            'doctor_name'   => 'required|string',
            'doctor_email'  => 'required|email',
        ]);

        Vaksinasi::create([
            'user_id'       => Auth::id(),
            'vaccine_name'  => $request->vaccine_name,
            'vaccine_date'  => $request->vaccine_date,
            'vaccine_time'  => $request->vaccine_time,
            'address'       => $request->address,
            'doctor_name'   => $request->doctor_name,
            'doctor_email'  => $request->doctor_email,
            'patient_email' => Auth::user()->email,
            'status'        => 'Belum',
        ]);

        return redirect()->route('menu-vaksin')->with('success', 'Jadwal vaksinasi berhasil ditambahkan.');
    }

    /**
     * Memperbarui status vaksinasi (oleh dokter)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Sudah,Dibatalkan',
        ]);

        $vaksin = Vaksinasi::findOrFail($id);
        $vaksin->status = $request->status;
        $vaksin->save();

        return redirect()->route('menu-vaksin')->with('success', 'Status vaksinasi berhasil diperbarui.');
    }

    /**
     * Menampilkan data detail vaksinasi (dipakai oleh modal fetch)
     */
    public function show($id)
    {
        $data = Vaksinasi::findOrFail($id);
        return response()->json($data);
    }
}
