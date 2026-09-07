<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllRead(): RedirectResponse
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back();
    }
}
