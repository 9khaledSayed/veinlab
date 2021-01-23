<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Doctor;
use App\Exports;
use App\HomeVisit;
use App\Hospital;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Patient;
use App\Profit;
use App\Revenue;
use App\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $patients_no           = Patient::get()->count();
        $male_patients_no      = Patient::where('gender',0)->count();
        $female_patients_no    = Patient::where('gender',1)->count();
        $child_patients_no     = Patient::where('gender',2)->count();

        $home_visits_no        = HomeVisit::get()->count();
        $male_home_visits_no   = HomeVisit::where('sex',0)->count();
        $female_home_visits_no = HomeVisit::where('sex',1)->count();
        $child_home_visits_no  = HomeVisit::where('sex',2)->count();

        $companies             = Company::select(array('name AS y','no_patients AS a'))->orderBy('no_patients', 'DESC')->take(10)->get()->toArray();
        $doctors               = Doctor::select(array('name AS y','no_patients AS a'))->orderBy('no_patients', 'DESC')->take(10)->get()->toArray();
        $hospitals             = Hospital::select(array('name AS y','no_patients AS a'))->orderBy('no_patients', 'DESC')->take(10)->get()->toArray();
        $sectors               = Sector::select(array('name AS y','no_patients AS a'))->orderBy('no_patients', 'DESC')->take(10)->get()->toArray();

        $companies_no          = Company::get()->count();
        $doctors_no            = Doctor::get()->count();
        $hospitals_no          = Hospital::get()->count();
        $sectors_no            = Sector::get()->count();

        $sumRevenue = Revenue::pluck('amount')->sum();
        $sumExports = Exports::pluck('amount')->sum();
        $profit     =  $sumRevenue - $sumExports;

        return view('dashboard.statistics.charts',compact(['patients_no','male_patients_no','female_patients_no','child_patients_no'
            ,'home_visits_no','male_home_visits_no','female_home_visits_no','child_home_visits_no'
            ,'companies','doctors','hospitals','sectors'
            ,'companies_no','doctors_no','hospitals_no','sectors_no'
            ,'sumRevenue','sumExports','profit']));
    }
}
