<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{   
    public function index()
    {
        $user = auth()->user();

        $notifications = $user->notifications;

        $user->unreadNotifications->markAsRead();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $user = auth()->user();

        $notification = $user->unreadNotifications->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        
        return response()->json(['success' => 'All notifications marked as read.']);
    }
}
