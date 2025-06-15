<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // REMOVED: The line 'use App\Models\Notification;' was here,
    // which incorrectly tried to use the Model as a Trait.
    // Models should be imported at the top of the file using the 'use' keyword.

    /**
     * Display a listing of the resource (notifications).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all notification records from the database
        $notifications = Notification::all();

        // Return the 'notifikasi.index' view, passing the retrieved notification data
        return view('notifikasi.index', compact('notifications'));
    }

    // You might also have other methods like 'store', 'show', 'edit', 'update', 'destroy' here.
    // Example: A method to mark a notification as read (assuming a 'read_at' column)
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['read_at' => now()]); // Assuming you have a 'read_at' timestamp column

        return redirect()->back()->with('success', 'Notification marked as read!');
    }
}
