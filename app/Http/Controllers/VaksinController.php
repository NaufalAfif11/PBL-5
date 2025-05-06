<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaksinController extends Controller
{
    public function index()
    {
        // Misalnya nanti kamu mau ambil data dari database, tinggal ganti di sini
        return view('vaksin.index'); // pastikan file resources/views/vaksin/index.blade.php ada
    }
}
