<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index()
    {
        $setting = setting()->all();
        return view('dashboard.settings.edit',compact('setting'));
    }



    public function store(Request $request)
    {
        $langVal = $request['language'];
        Session::put('locale', $langVal);
        return $this->saveSetting($request);
    }

    public function critical(Request $request){
        if($request->isMethod('get')){
            $setting = setting()->all();
            return view('dashboard.settings.critical',compact('setting'));
        }
        $request->validate([
            'max_id_no' => 'required|min:0',
            'max_phone_no' => 'required|min:0',
            'whatsapp_result_msg' => 'required|string',
        ]);
        return $this->saveSetting($request);
    }
    public function language(Request $request){
        if($request->isMethod('get')){

            $setting = setting()->all();
            return view('dashboard.settings.language',compact('setting'));
        }
        Session::put('locale', $request['language']);
        return $this->saveSetting($request);
    }
    public function offers(Request $request){
        if($request->isMethod('get')){
            $setting = setting()->all();
            return view('dashboard.settings.offers',compact('setting'));
        }
        return $this->saveSetting($request);
    }
    public function tax(Request $request){

        if($request->isMethod('get')){
            $setting = setting()->all();
            return view('dashboard.settings.tax',compact('setting'));
        }
        return $this->saveSetting($request);
    }

    public function working_hours(Request $request){
        if($request->isMethod('get')){
            $setting = setting()->all();
            return view('dashboard.settings.hr_settings',compact('setting'));
        }
        setting(['working_hours' => intval($request['working_hours'])])->save();
        return redirect()->back();
    }

    public function days_off(Request $request){
        if($request->isMethod('get')){
            $setting = setting()->all();
            return view('dashboard.settings.hr_settings',compact('setting'));
        }
        setting(['days_off' => intval($request['days_off'])])->save();
        return redirect()->back();
    }
    public function release_day(Request $request){
        if($request->isMethod('get')){
            $setting = setting()->all();
            return view('dashboard.settings.hr_settings',compact('setting'));
        }
        setting(['release_day' => intval($request['release_day'])])->save();
        return redirect()->back();
    }

    public function saveSetting($request)
    {
        setting($request->all())->save();
        return redirect()->back()->with('message', 'saved!');
    }

}
