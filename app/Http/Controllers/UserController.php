<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profil()
{
    $user = auth()->user();
    return view('user.profil', compact('user'));
}

}
