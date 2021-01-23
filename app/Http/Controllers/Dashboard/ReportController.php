<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Doctor;
use App\Hospital;
use App\Http\Controllers\Controller;
use App\MainAnalysis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_reports');
        return view('dashboard.reports.index');
    }
    public function print(Request $request)
    {
        $this->authorize('view_reports');
        if(isset($request->date)) {
            $date = Carbon::create($request->date);
            $companies = Company::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $hospitals = Hospital::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $doctors = Doctor::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $main_analysis = MainAnalysis::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $data = ['companies', 'companies_dues', 'hospitals', 'doctors', 'main_analysis', 'total_hospitals_amount', 'total_doctors_amount', 'total_analysis_amount', 'total_cost', 'total_profits','date'];
        }else{
            $companies = Company::get();
            $hospitals = Hospital::get();
            $doctors = Doctor::get();
            $main_analysis = MainAnalysis::get();
            $data = ['companies', 'companies_dues', 'hospitals', 'doctors', 'main_analysis', 'total_hospitals_amount', 'total_doctors_amount', 'total_analysis_amount', 'total_cost', 'total_profits'];
        }
        $companies_dues = array_sum($companies->pluck('our_money')->toArray());
        $total_hospitals_amount = array_sum($hospitals->pluck('wallet')->toArray());
        $total_doctors_amount = array_sum($doctors->pluck('wallet')->toArray());
        $total_analysis_amount = $main_analysis->pluck('price')->sum();
        $total_cost = $main_analysis->pluck('cost')->sum();
        $total_profits = $main_analysis->map(function ($analysis) {
            return ($analysis->demand_no * $analysis->price) - ($analysis->demand_no * $analysis->cost);
        })->sum();
        return view('dashboard.reports.print', compact($data));
    }
}
