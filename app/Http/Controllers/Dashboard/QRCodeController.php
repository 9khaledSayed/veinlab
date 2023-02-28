<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use QrCode;


class QRCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function generate(Request $request)
    {

        $employee = auth()->user();
        /*** check if employee is mobile owner ***/

        /** check if cookies contains an employee id **/
        if (array_key_exists('employee_id', $_COOKIE)){


            /** check if the current employee id not equal to the employee id then alert the manager **/
            if ($_COOKIE['employee_id'] != auth()->id()){
//                dd('you cannot use another device to check in');
            }else{
                /** else use it in the qr code  **/
                $qr = $_COOKIE['employee_id'];

                auth()->user()->setMobileOwner();
            }

        }else{
            /** else if not then set a cookie that contain the current employee id  and use it in the qr code **/
            setcookie('employee_id', auth()->id(), time() + (10 * 365 * 24 * 60 * 60), '/');
            $qr = auth()->id();
            auth()->user()->setMobileOwner();
        }


        /*** check if employee is inside the lab ***/
        if($this->distance($request->lat, $request->lng, setting('lat'), setting('lng'), 'M') <= 0.55){
            auth()->user()->setInLab();
        }




        return view('dashboard.qr_code.generate', compact('qr'));
    }

    public function scanner(Request $request)
    {

        return view('dashboard.qr_code.scanner');
    }


    function distance($lat1, $lng1, $lat2, $lng2, $unit) {
        if (($lat1 == $lat2) && ($lng1 == $lng2)) {
            return 0;
        }
        else {
            $theta = $lng1 - $lng2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }


    public function test(Request $request)
    {
        if ($request->isMethod('post')){
            dd($request->toArray());
        }

        return view('dashboard.qr_code.test');
    }

}
