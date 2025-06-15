<?php // Ensure this is at the very top of your file

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // <-- Move this line here!

class NotificationController extends Controller
{
    public function index()
    {
        // Now, 'Notification' here correctly refers to your imported model class
        $notifications = Notification::all();
        return view('notifikasi.index', compact('notifications'));
    }
}