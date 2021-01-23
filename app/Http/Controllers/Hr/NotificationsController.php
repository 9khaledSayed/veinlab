<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    public function markAsRead($id,Request $request)
    {

      $notifictaions =  Auth::guard('employee')->user()->notifications();

      $notifictaions->find($id)->markAsRead();

    }
}
