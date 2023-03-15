<?php

namespace App\Http\Controllers\Hr;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Setting;
use League\Flysystem\Adapter\Local;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function company_info(Request $request)
    {
        // dd($request->isMethod('post'));
        $this->authorize('view_company_info');
        if ($request->isMethod('post')){
            $this->validate($request, [
                'logo_url' => 'nullable|image|mimes:jpeg,png,jpg',
                'company_stamp' =>  'nullable|image|mimes:jpeg,png,jpg',
                'ceo_signature' =>  'nullable|image|mimes:jpeg,png,jpg',
                'header' =>  'nullable|image|',
                'footer' =>  'nullable|image|',
            ]);
            //process
            if(isset($request->logo_url)){
                $fileName = $request->file('logo_url')->getClientOriginalName();
                $request->file('logo_url')->storeAs('public/company_info', $fileName);
                $request['logo_path'] = 'storage/company_info/' . $fileName ;

            }
            if(isset($request->company_stamp)) {
                $fileName = $request->file('company_stamp')->getClientOriginalName();
                $fileName = 'Nabd_'.time()  . $fileName;
                $request->file('company_stamp')->storeAs('public/company_info', $fileName);
                $request['company_stamp_path'] = 'storage/company_info/' . $fileName;
            }
            if(isset($request->ceo_signature)) {
                $fileName = $request->file('ceo_signature')->getClientOriginalName();
                $fileName = 'Nabd_'.time()  . $fileName;
                $request->file('ceo_signature')->storeAs('public/company_info', $fileName);
                $request['ceo_signature_path'] = 'storage/company_info/' . $fileName;
            }
            if(isset($request->header)) {
                $fileName = $request->file('header')->getClientOriginalName();
                $fileName = 'Nabd_'.time()  . $fileName;
                $request->file('header')->storeAs('public/company_info', $fileName);
                $request['header_path'] = 'storage/company_info/' . $fileName ;
            }
            if(isset($request->footer)) {
                $fileName = $request->file('footer')->getClientOriginalName();
                $fileName = 'Nabd_'.time()  . $fileName;
                $request->file('footer')->storeAs('public/company_info', $fileName);
                $request['footer_path'] = 'storage/company_info/' . $fileName ;
            }


            //store
            Setting::set($request->all());
            Setting::save();


//            dd(setting('lat'), setting('lng'));
            return redirect()->back()->with('message', 'done');
        }
        $setting = Setting::all();
        $employees = Employee::get();
        return view('hr.settings.company_info', compact(['setting', 'employees']));
    }


    public function index_hr()
    {
        $this->authorize('view_system_settings');
        $setting = Setting::all();
        return view('hr.settings.hr_settings',compact('setting'));
    }

    public function hr_store(Request $request)
    {

        Setting::set($request->all());
        Setting::save();
        Session::put('locale', $request['language']);
        return redirect()->back()->with('message', 'Email Sent!');
    }

    public function shifts()
    {
        $this->authorize('view_work_shifts');
        $setting = Setting::all();
        return view('hr.settings.shifts',compact('setting'));
    }


    public function shiftsStore(Request $request)
    {

        Setting::set($request->all());
        Setting::save();

        return redirect()->back()->with('message', 'Email Sent!');
    }
}
