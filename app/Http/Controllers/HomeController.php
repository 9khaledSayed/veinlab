<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        dd(auth()->user());
        return view('home');
    }


//    public function mailMe()
//    {
//        $revenueAmounts   = Revenue::whereDate('created_at' , Carbon::tomorrow())->pluck('amount')->toArray();
//        $sumRevenue = array_sum($revenueAmounts);
//
//        $exportsAmounts   = Exports::whereDate('created_at' , Carbon::tomorrow())->pluck('amount')->toArray();
//        $sumExports = array_sum($exportsAmounts);
//
//        $no_patients      = Invoice::whereDate('created_at' , Carbon::tomorrow())->count();
//
//        $no_new_patients  = Patient::whereDate('created_at' , Carbon::tomorrow())->count();
//
//        $profit = $sumRevenue - $sumExports;
//
//        $data = ['sumRevenue' => $sumRevenue,
//            'sumExports' => $sumExports,
//            'no_patients' => $no_patients,
//            'no_new_patients' => $no_new_patients,
//            'profit' => $profit];
//
//        Mail::to('khaled@gmail.com')
//              ->send(new DailyReport($data));
//
//        return 'done';
//
//    }
}
