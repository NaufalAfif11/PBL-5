<?php // Ensure this is at the very top of your file

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('dokter.notifikasi', compact('notifications'));
    }
}
