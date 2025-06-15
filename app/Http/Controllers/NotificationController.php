<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use App\Models\Notification;

public function index()
{
    $notifications = Notification::all();
    return view('notifikasi.index', compact('notifications'));
}
//
}
