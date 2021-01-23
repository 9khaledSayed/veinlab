<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NotificationsController extends Controller
{
    public function waitingLab()
    {

        if ( auth()->user()->abilities()->contains("doctor_notifications") )
        {

            $notifictaions =  Employee::find(1)->unreadNotifications()->
            where('type','App\Notifications\ResultToDoctor')->get();

        }elseif (auth()->user()->abilities()->contains("waiting_lab_notifications")){

            $notifictaions =  Employee::find(1)->unreadNotifications()->
            where('type','App\Notifications\WaitingLabNotification')->get();

        }elseif (auth()->user()->abilities()->contains("create_patients")){

            $notifictaions =  Employee::find(1)->unreadNotifications()->
            where('type','App\Notifications\HomeVisitNotification')->get();

        }


        return response()->json($notifictaions);
    }

    public function markAsRead($id,Request $request)
    {
        if($request['type'] == 0)
        {
            $notifictaions =  \App\Employee::find(1)->notifications();
            $notifictaions->find($id)->markAsRead();

        }elseif ($request['type'] == 1) {

            $notifictaions =  \App\Patient::find(Auth::guard('patient')->user()->id)->notifications();
            $notifictaions->find($id)->markAsRead();

        }
    }
}
