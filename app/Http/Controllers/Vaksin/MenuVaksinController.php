<?php

namespace App\Http\Controllers\Vaksin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaccine; // Pastikan model ini benar

class MenuVaksinController extends Controller
{
    public function index()
    {
        $vaccines = Vaccine::all(); // ambil semua data vaksin
        return view('menu-vaksin', compact('vaccines'));
    }
}

