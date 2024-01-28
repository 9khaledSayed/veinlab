<?php

namespace App\Http\Controllers\Dashboard;

use App\Mail\PromoCodeEmail;
use App\MainAnalysis;
use App\Notifications\PromoCodeNotification;
use App\Patient;
use App\PromoCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class PromoCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee,patient');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $promoCodes = PromoCode::all();
            return response()->json($promoCodes);
        }
        return  view('dashboard.promo_codes.index');
    }

    public function create()
    {
        $main_analysis = MainAnalysis::get();
        $channels = [
            'Notifications' =>'database',
            'Emails'        =>'mail'
        ];
        return view('dashboard.promo_codes.create', compact(['main_analysis', 'channels']));
    }


    public function store(Request $request)
    {
        $this->validator($request);
        $type = $request->type;
        $analysis = null;
        $include = $request->include;
        $main_analysis_id = $request->main_analysis_id;
        $percentage = $request->percentage;
        $ranges = explode(' / ', $request->ranges);
        $from = $ranges[0];
        $to = $ranges[1];
        $code = $request->code;
        // store
        PromoCode::create([
           'main_analysis_id' => $main_analysis_id,
            'percentage'      => $percentage,
            'code'            => $code,
            'from'            => $from,
            'to'              => $to,
            'type'            => $type,
            'include'         => $include   // 1 all 2 individual 3 contract
        ]);

        $notification_type = $request->notify;
         //send notifications
        if(isset($main_analysis_id)){
            $analysis = MainAnalysis::find($main_analysis_id)->general_name;
        }

        if($request->has('notify')){
            $this->send_notifications($request, $include, $code, $percentage, $analysis, $from, $to);
            return redirect(route('dashboard.promo_codes.index'))->with('message', 'Email Sent!');
        }
        return redirect(route('dashboard.promo_codes.index'));
    }


    public function show(PromoCode $promoCode)
    {
        //
    }


    public function edit(PromoCode $promoCode)
    {
        $main_analysis = MainAnalysis::get();
        $channels = [
            'Notifications' =>'database',
            'Emails'        =>'mail'
        ];
        return view('dashboard.promo_codes.edit', compact(['main_analysis', 'channels', 'promoCode']));
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        if($request->code == $promoCode->code){
            $this->validate($request, [
                'main_analysis_id'   => ['nullable', 'max:255', 'numeric'],
                'percentage'        => ['required', 'max:100', 'numeric'],
                'ranges'            => ['required', 'max:255', 'string'],
                'type'              => ['required'],
                'include'           => ['required']
            ]);
        }else{
            $this->validator($request);
        }

        $type = $request->type;
        $analysis = null;
        $include = $request->include;
        $main_analysis_id = $request->main_analysis_id;
        $percentage = $request->percentage;
        $ranges = explode(' / ', $request->ranges);
        $from = $ranges[0];
        $to = $ranges[1];
        $code = $request->code;
        // store
        $promoCode->update([
            'main_analysis_id' => $main_analysis_id,
            'percentage'      => $percentage,
            'code'            => $code,
            'from'            => $from,
            'to'              => $to,
            'type'            => $type,
            'include'         => $include   // 1 all 2 individual 3 contract
        ]);

        $notification_type = $request->notify;
        //send notifications
        if(isset($main_analysis_id)){
            $analysis = MainAnalysis::find($main_analysis_id)->general_name;
        }

        if($request->has('notify')){
            $this->send_notifications($request, $include, $code, $percentage, $analysis, $from, $to);
            return redirect(route('dashboard.promo_codes.edit', $promoCode))->with('message', 'Email Sent!');
        }

        return redirect(route('dashboard.promo_codes.edit', $promoCode));
    }

    public function destroy(Request $request, PromoCode $promoCode)
    {
        $this->authorize('delete_promo_codes');
        if($request->ajax()){
            $promoCode->delete();
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.employees.index'));
    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
           'main_analysis_id'   => ['nullable', 'max:255', 'numeric', 'unique'],
            'percentage'        => ['required', 'max:100', 'numeric'],
            'ranges'            => ['required', 'max:255', 'string'],
            'type'              => ['required'],
            'code'              => ['required', 'unique:promo_codes'],
            'include'           => ['required']
        ]);
    }

    public function send_notifications(Request $request , $include,$code,$percentage, $analysis, $from, $to)
    {
        foreach (Patient::get() as $patient){
            if(isset($patient->email)){
                $patient->notify(new PromoCodeNotification($request, $code, $percentage, $analysis, $patient->name, $from, $to));
            }
        }
    }

    public function showPromocode($code)
    {

        $promoCode = PromoCode::where('code',$code)->first();

        return view('notifications.promo-code',compact('promoCode'));
    }
}
