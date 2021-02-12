<?php

namespace App\Http\Controllers\Dashboard;

use App\Doctor;
use App\Employee;
use App\Exports;
use App\HomeVisit;
use App\Hospital;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\MainAnalysis;
use App\Patient;
use App\Result;
use App\Revenue;
use App\Role;
use App\SubAnalysis;
use App\WaitingLab;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
//        Mail::raw('it works',function ($message){
//            $message->to('ahmed.gamal1999@gmail.com');
//        });
        $user = auth()->user();
        $user->assignRole(Role::find(1));
        dd($user->roles->pluck('label'), Auth::guard('employee')->check(), $user->roles->pluck('label')->contains('Super Admin'));
        if(Auth::guard('employee')->check() && $user->roles->pluck('label')->contains('Super Admin')){

            $patients = Patient::latest()->take(5)->get();
            $sumRevenue = Revenue::pluck('amount')->sum();
            $sumExports = Exports::pluck('amount')->sum();
            $profit     =  $sumRevenue - $sumExports;
            return view('dashboard.super_admin_view',[
                'patients_no'    => Patient::get()->count(),
                'employees_no'    => Employee::get()->count(),
                'doctors_no'    => Doctor::get()->count(),
                'hospitals_no'    => Hospital::get()->count(),
                'companies_no'    => Hospital::get()->count(),
                'home_visits_no'    => HomeVisit::get()->count(),
                'latest_patients'   => $patients,
                'sumRevenue'   => $sumRevenue,
                'sumExports'   => $sumExports,
                'profit'   => $profit,
            ]);
        }elseif (Auth::guard('employee')->check() && $user->roles->pluck('label')->contains('Receptionist')){

            $patients = Patient::latest()->take(5)->get();
            return view('dashboard.receptionist_view',[
                'patients_no'       => Patient::get()->count(),
                'home_visits_no'    => HomeVisit::get()->count(),
                'invoices_no'    => Invoice::whereDate('created_at', Carbon::today())->get()->count(),
                'latest_patients'   => $patients
            ]);
        }elseif (Auth::guard('employee')->check() && ($user->roles->pluck('label')->contains('Lab')|| $user->roles->pluck('label')->contains('Doctor'))){
//            dd(auth()->user()->unreadNotifications()->first()->data['url']);
            $patients = Patient::latest()->take(5)->get();
            return view('dashboard.lab_view',[
                'patients_no'       => Patient::get()->count(),
                'waiting_no'    => WaitingLab::whereDate('created_at', Carbon::today())->get()->count(),
                'invoices_no'       => Invoice::whereDate('created_at', Carbon::today())->get()->count(),
                'latest_patients'   => $patients
            ]);
        }elseif (Auth::guard('employee')->check() && $user->roles->pluck('label')->contains('Accountant')){

            $invoices = Invoice::latest()->take(5)->get();
            return view('dashboard.accountant_view',[
                'patients_no'       => Patient::get()->count(),
                'waiting_no'    => WaitingLab::whereDate('created_at', Carbon::today())->get()->count(),
                'invoices_no'       => Invoice::whereDate('created_at', Carbon::today())->get()->count(),
                'latest_invoices'   => $invoices
            ]);
        }elseif (Auth::guard('employee')->check() && $user->roles->pluck('label')->contains('Attendance Account')){
            return redirect(route('dashboard.hr.attendance.create'));
        }elseif (Auth::guard('patient')->check() || Auth::guard('hospital')->check()){
            return view('dashboard.results.index');
        }else{
            return view('dashboard.default_view');
        }

    }
}
