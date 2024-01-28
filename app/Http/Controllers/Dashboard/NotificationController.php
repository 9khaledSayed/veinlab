<?php

namespace App\Http\Controllers\Dashboard;

use App\Ability;
use App\Employee;
use App\Http\Controllers\Controller;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Notification::authNotifications()->where('id', $id)->first();
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }

    public function loadMore($next)
    {
        $notifications = Employee::first()->notifications->skip($next + 1)->take(5);

        $next = key(array_slice($notifications->toArray(),-1, 1, true));

        return response()->json([
            'data' => $notifications,
            'next' => $next
        ]);
    }
}
