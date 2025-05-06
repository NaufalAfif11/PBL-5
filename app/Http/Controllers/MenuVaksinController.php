<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuVaksinController extends Controller
{
    public function index()
    {
        return view('menu-vaksin');
    }
}
