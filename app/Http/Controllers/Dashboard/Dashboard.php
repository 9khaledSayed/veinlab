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
use App\Revenue;
use App\WaitingLab;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
    
        $user = auth()->user();
        if(Auth::guard('employee')->check() && $user->roles->pluck('label')->contains('Super Admin')){

            $patients = Patient::latest()->take(10)->get();
            $topSellingMainAnalyses = MainAnalysis::orderBy('demand_no', 'desc')->take(10)->get();
            $spending = $this->spendingPerMonth()['data'];
            $income = $this->incomePerMonth()['data'];
            $profits = [
                'spending' => $spending,
                'income' => $income,
                'total_profits' => array_map(function ($x, $y) { return $x - $y; } , $income, $spending),
            ];



            return view('dashboard.super_admin_view',[
                'patients_no'    => Patient::get()->count(),
                'employees_no'    => Employee::get()->count(),
                'doctors_no'    => Doctor::get()->count(),
                'hospitals_no'    => Hospital::get()->count(),
                'companies_no'    => Hospital::get()->count(),
                'home_visits_no'    => HomeVisit::get()->count(),
                'latest_patients'   => $patients,
                'topSellingMainAnalyses'   => $topSellingMainAnalyses,
                'profits'   => $profits,
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
            return redirect(route('dashboard.qr_code.scanner'));
        }elseif (Auth::guard('patient')->check() || Auth::guard('hospital')->check()){
            return view('dashboard.results.index');
        }else{
            return view('dashboard.default_view');
        }

    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }


    function countPerMonth($modelName){

        $model = app('\\App\\' . $modelName);
        $array = array();

        for($i = 1 ; $i <= 12 ; $i++ )
        {
            $MonthCount = $model::whereYear('created_at', now()->year)->whereMonth('created_at', $i)->count();
            array_push($array,$MonthCount);
        }

        return ['data' => $array, 'min' => 0, 'max' => max($array), 'total' => $model::count()];
    }


    function spendingPerMonth(){

        $array = array();

        for($i = 1 ; $i <= 12 ; $i++ )
        {  
            $MonthCount = Invoice::withoutGlobalScopes()->where('pay_method', '!=', config('enums.payMethod.overdue'))->whereYear('created_at', now()->year)->whereMonth('created_at', $i)->pluck('total_cost')->sum();
            $MonthCount += Exports::whereYear('created_at', now()->year)->whereMonth('created_at', $i)->pluck('amount')->sum();
            array_push($array,$MonthCount);
        }

        return ['data' => $array, 'min' => 0, 'max' => max($array), 'total' => Invoice::max('total_price')];
    }

    function incomePerMonth(){

        $array = array();

        for($i = 1 ; $i <= 12 ; $i++ )
        {
            $MonthCount = Invoice::where('pay_method', '!=', config('enums.payMethod.overdue'))->whereYear('created_at', now()->year)->whereMonth('created_at', $i)->pluck('total_price')->sum();
            $MonthCount += Revenue::whereYear('created_at', now()->year)->whereMonth('created_at', $i)->pluck('amount')->sum();
            array_push($array,$MonthCount);
        }

        return ['data' => $array, 'min' => 0, 'max' => max($array), 'total' => Invoice::max('total_price')];
    }
}
