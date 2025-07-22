<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vaksinasi;
use App\Models\Availability;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     */
    public function dashboard()
    {
        $doctors = User::where('role', 'dokter')->get();
        $vaccines = Vaksinasi::all();

       return view('admin.dashboard', compact('doctors', 'vaccines'));
    }

    /**
     * Menampilkan halaman pengelolaan jadwal dokter.
     */
    public function kelolaJadwal()
    {
        $dokter = User::where('role', 'dokter')->get();
        return view('admin.kelola-jadwal', compact('dokter'));
    }

    /**
     * Menyimpan data jadwal ketersediaan dokter.
     */
    public function storeJadwal(Request $request)
    {
        $request->validate([
            'doctor_id'    => 'required|exists:users,id',
            'hari'         => 'required|string',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required|after:jam_mulai',
        ]);

        Availability::create([
            'doctor_id'   => $request->doctor_id,
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }
    public function updateJadwal(Request $request, $id)
{
    $request->validate([
        'hari'         => 'required|string',
        'jam_mulai'    => 'required',
        'jam_selesai'  => 'required|after:jam_mulai',
    ]);

    $jadwal = Availability::findOrFail($id);
    $jadwal->update([
        'hari'        => $request->hari,
        'jam_mulai'   => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
    ]);

    return back()->with('success', 'Jadwal berhasil diperbarui.');
}


    /**
     * Menampilkan daftar seluruh jadwal dokter.
     */
    public function indexAvailability()
    {
        $availabilities = Availability::with('doctor')->get();
        return view('admin.availability.index', compact('availabilities'));
    }

    /**
     * Menampilkan halaman pengelolaan vaksin.
     */
    public function kelolaVaksin()
    {
        $dokter = User::where('role', 'dokter')->get();
        return view('admin.kelola-vaksin', compact('dokter'));
    }

    /**
     * Menampilkan form untuk menautkan vaksin ke dokter.
     */
    public function assignVaccine()
    {
        $doctors = User::where('role', 'dokter')->get();
        $vaksinasis = Vaksinasi::all();
        return view('admin.vaksinasi.assign', compact('doctors', 'vaksinasis'));
    }

    /**
     * Menyimpan relasi vaksin ke dokter (many-to-many).
     */
    public function storeVaksin(Request $request)
    {
        $request->validate([
            'doctor_id'       => 'required|exists:users,id',
            'vaksinasi_ids'   => 'required|array',
            'vaksinasi_ids.*' => 'exists:vaksinasis,id',
            'hari'            => 'required|string',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required|after:jam_mulai',
        ]);

        // Simpan relasi vaksin ke dokter
        $doctor = User::find($request->doctor_id);
        $doctor->vaksinasis()->sync($request->vaksinasi_ids);

        // Simpan jadwal praktik
        Availability::create([
            'doctor_id'   => $request->doctor_id,
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->back()->with('success', 'Vaksin dan jadwal berhasil ditautkan ke dokter.');
    }
}
