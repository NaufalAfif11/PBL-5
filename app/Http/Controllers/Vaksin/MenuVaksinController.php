<?php

namespace App\Http\Controllers\Vaksin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuVaksinController extends Controller
{
    public function index()
    {
        return view('menu-vaksin'); // Sesuaikan dengan nama view Anda
    }
}
