<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\MainAnalysis;
use App\Nationality;
use App\Notifications\WaitingLabNotification;
use App\Package;
use App\PromoCode;
use App\Sector;
use App\WaitingLab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Patient;
use App\Company;
use App\Doctor;
use App\Hospital;
use Illuminate\Support\Facades\Notification;

class WaitingLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_waiting_labs');
        if ($request->ajax()) {
          
            $response = getModelData(
                new WaitingLab(),
                $request, 
                ['patient' => ['name'], 'main_analysis' => ['general_name'], 'invoice' => ['barcode', 'serial_no']],
                [['result','<','3']]);

            return response()->json($response);
        }
        return view('dashboard.waiting_labs.index');
    }

    public function create()        // existing account
    {
        $this->authorize('create_patients');
        return  view('dashboard.waiting_labs.create', [
            'hospitals'      => Hospital::all(),
            'doctors'        => Doctor::all(),
            'companies'      => Company::all(),
            'main_analysis'  => MainAnalysis::all(),
            'packages'       => Package::all(),
            'sectors'       => Sector::all(),
            'patients' => Patient::get(),
            'promo_codes'    => PromoCode::where('from', '<=', Carbon::today())->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create_patients');
        $this->validator($request);
        if ($request->ajax()){
            $receipt = $this->calculateTotalPrice($request, $responseArray);
            return response()->json($receipt);
        }else{
            $invoice = $this->calculateTotalPrice($request, $responseArray);
            $this->generateWaitingLabs($invoice);
            $this->assignTransfer($request, $invoice->total_price);

            return redirect(route('dashboard.invoices.show', $invoice->id));
        }
    }


    public function show($waiting_lab_id)
    {
//      $this->authorize('update_results');
        $waiting_lab = WaitingLab::with(['main_analysis','results.sub_analysis', 'patient', 'notes'])->find($waiting_lab_id);
        $genderType = ['male', 'female', 'child', 'both'];
        $index = 0;
        return view('dashboard.waiting_labs.show',[
            'main_analysis'  => $waiting_lab->main_analysis,
            'results'        => $waiting_lab->results ,
            'sub_analysis'   => $waiting_lab->main_analysis->sub_analysis,
            'gender'         => $waiting_lab->patient->gender,
            'waiting_lab'    => $waiting_lab,
            'notes'          => $waiting_lab->notes,
            'genderType'     => $genderType,
            'invoice_id'     => $waiting_lab->invoice_id,
            'index' => $index
        ]);

    }

    public function edit(WaitingLab $waitingLab)
    {
        $this->authorize('view_waiting_labs');
        $waitingLab->update([
           'result' => 3
        ]);
        return redirect(route('dashboard.waiting_labs.index'));
    }

    public function archives(Request $request)
    {
        $this->authorize('view_waiting_labs');
        if ($request->ajax()) {

            $response = getModelData(
                new WaitingLab(),
                $request, 
                ['patient' => ['name'], 'main_analysis' => ['general_name'], 'invoice' => ['barcode', 'serial_no']],
                [['result','=','3']]);

            return response()->json($response);
        }
        return view('dashboard.waiting_labs.archives');
    }


    public function disApprove($id){
        Employee::first()->notify(new WaitingLabNotification("تم رفض تحليل ويجب اعادة رصد النتيجة مرة اخرى", 'flaticon-warning-sign',"warning", route('dashboard.results.edit', $id)));
        pushNotification();
    }


    public function calculateTotalPrice(Request $request, &$responseArray)
    {
        $price = 0;
        $mainAnalysis = MainAnalysis::whereIn('id', $request->main_analysis_id??[])->get();
        $packages = Package::whereIn('id', $request->package_id??[])->get();
        $purchases = [];

        switch ($request->transfer){
            case config('enums.transfer.contract'):
                foreach ($mainAnalysis as $analysis) {
                    $price += $analysis->price_insurance;
                    $purchases[$analysis->general_name] = ['price' => $analysis->price_insurance, 'code' => $analysis->code, 'discount' => 0];
                }
                break;
            case config('enums.transfer.hospital'):

                $hospital = Hospital::find($request->hospital_id);
                /** get hospital main analysis **/
                $hospitalMainAnalysis = $hospital->main_analyses()->whereIn('id', $request->main_analysis_id)->get()->map(function ($main){
                    return [
                        'id' => $main->id,
                        'general_name' => $main->general_name,
                        'price' => $main->pivot->price,
                        'code' => $main->code,
                    ];
                });
                /** get all main analysis except hospital analysis **/
                $main_analysis = MainAnalysis::whereIn('id', $request->main_analysis_id)->get()->map(function ($main){
                    return [
                        'id' => $main->id,
                        'general_name' => $main->general_name,
                        'price' => $main->price,
                        'code' => $main->code,
                    ];
                })->whereNotIn('id', $hospitalMainAnalysis->pluck('id')->toArray());


                $main_analysis = $main_analysis->merge($hospitalMainAnalysis);

                foreach ($main_analysis as $analysis) {
                    /** check hospital amount type **/

                    $price += $analysis['price'];
                    $purchases[$analysis['general_name']] = ['price' => $analysis['price'], 'code' => $analysis['code'], 'discount' => 0];
                }
                break;
            case config('enums.transfer.sector'):
                foreach ($mainAnalysis as $analysis) {
                    $price += $analysis->price;
                    $purchases[$analysis->general_name] = ['price' => $analysis->price, 'code' => $analysis->code, 'discount' => 0];
                }
                break;
            default :
                foreach ($mainAnalysis as $analysis) {
                    $price += $analysis->price - $analysis->discount;
                    $purchases[$analysis->general_name] = ['price' => $analysis->price, 'code' => $analysis->code, 'discount' => $analysis->discount];
                }
                foreach ($packages as $package) {
                    $price += $package->price;
                    $purchases[$package->name] = ['price' => $package->price, 'code' => '-', 'discount' => 0];
                }
        }

        if($request->home_visit_fees == 'on'){
            $price += setting('home_visit_fees');
            $purchases['Home Visit Fees'] = [
                'price' => setting('home_visit_fees'),
                'code' => '-',
                'discount' => 0
            ];
        }

        $tax = $this->getTax($request, $price);
        $price += $tax;
        $discount = $this->calculateDiscount($request, $price, $responseArray);
        $price -= $discount;

        if($request->ajax()){
            $responseArray['total_price'] = $price;
            return $responseArray;
        }else{
            return $this->storeInvoice($request, $price, $discount, $tax, $purchases);
        }

    }

    public function calculateDiscount(Request $request , $totalPrice, &$responseArray)
    {
        $discount = 0;
        if($request->transfer == config('enums.transfer.contract')){

            $discount = (Category::find($request->category_id)->percentage / 100) * $totalPrice;

        }elseif($request->transfer == config('enums.transfer.sector')){

            $percentage = Sector::find($request->sector_id)->value('percentage');
            $discount = ($totalPrice * ($percentage / 100));

        }

        $discount += $this->discountFromOffers($request, $totalPrice, $responseArray);

        $discount += $request->discount;
        return $discount;
    }

    public function discountFromOffers(Request $request, $totalPrice, &$responseArray)
    {
        // loyalty points

        $discount = 0;
        $patient = Patient::find($request->patient_id);
        if($patient->visit_no >= setting('no_visits') && in_array(setting('loyalty_discount_include'), [config('enums.transfer.all'), $request->transfer])){
            $loyaltyDiscPercentage = setting('loyalty_discount_value');   // percentage
            $discount = $totalPrice * ($loyaltyDiscPercentage/100);
        }

        // total price discount

        if($totalPrice >= setting('invoice_value') && in_array(setting('invoice_discount_include'), [config('enums.transfer.all') ,$request->transfer])){
            $discount += setting('invoice_discount_value');
            $responseArray['has_invoice_discount'] = setting('invoice_discount_value') > 0;
            $responseArray['discount'] = setting('invoice_discount_value');
            $responseArray['maximum_reach_value'] = setting('invoice_value');
        }

        // promo code discount
        if($request->promo_code == 1) {
            $promo_code = PromoCode::find($request->code_id);
            if($promo_code->type == config('enums.promoCodeOn.invoice')){   // promo code on the invoice
                $discount += $totalPrice * ($promo_code->percentage / 100);
            }else if ($promo_code->type == config('enums.promoCodeOn.analysis')){
                $promoCodeAnalysis = $promo_code->main_analysis;
                $patientTransferIncluded = in_array($promo_code->include, [config('enums.transfer.all'), $request->transfer]);

                if(in_array($promoCodeAnalysis->id, $request->main_analysis_id) && $patientTransferIncluded){
                    $discount += floatval($promoCodeAnalysis->price * ($promo_code->percentage/100));
                }
            }
        }
        $responseArray['total_price'] = $totalPrice;
        return $discount;
    }

    public function getTax(Request $request, $totalPrice)
    {
        $tax = 0;
        $nationalityLabel = Patient::find($request->patient_id)->nationality_label;


        if(setting('tax_include') == config('enums.taxInclude.all')){

            $tax = $totalPrice * (setting('tax')/100);
        }elseif (setting('tax_include') == config('enums.taxInclude.saudi')){

            /** check if patient is saudi **/
            if ($nationalityLabel == 'sa'){
                $tax = $totalPrice * (setting('tax')/100);
            }

        }elseif (setting('tax_include') == config('enums.taxInclude.not_saudi')){
            /** check if patient is not saudi **/
            if ($nationalityLabel != 'sa'){
                $tax = $totalPrice * (setting('tax')/100);
            }
        }


        return $tax;
    }

    public function storeInvoice(Request $request, $price, $discount, $tax, $purchases)
    {
        return Invoice::create([
            'patient_id'    => $request->patient_id,
            'doctor_id'     => $request->doctor_id,
            'hospital_id'   => $request->hospital_id,
            'transfer'      => $request->transfer,
            'company_id'    => $request->company_id,
            'category_id'   => $request->category_id,
            'promo_code_id' => $request->code_id ?? null,
            'policy_no'     => $request->policy_no,
            'purchases'     => serialize($purchases),
            'tax'           => $tax,
            'status'        => 1,
            'main_analysis' => serialize($request->main_analysis_id),
            'packages'      => serialize($request->package_id),
            'total_price'   => $price,
            'discount'      => $discount,
            'pay_method'    => $request->pay_method,
            'amount_paid'   => $request->amount_paid,
        ]);
    }

    public function generateWaitingLabs(Invoice $invoice)
    {

        $mainAnalysis = MainAnalysis::whereIn('id', unserialize($invoice->main_analysis) ?? [])->get();
        $mainAnalysisFromPackages = Package::whereIn('id', unserialize($invoice->packages) ?? [])->get()->map(function($package){
            return MainAnalysis::whereIn('id', unserialize($package->main_analysis))->get();
        })->flatten();

        foreach ($mainAnalysis as $analysis) {
            WaitingLab::create([
                'patient_id' => $invoice->patient->id,
                'main_analysis_id' => $analysis->id,
                'invoice_id'=> $invoice->id
            ]);
        }
        foreach ($mainAnalysisFromPackages as $analysis) {
            WaitingLab::create([
                'patient_id' => $invoice->patient->id,
                'main_analysis_id' => $analysis->id,
                'invoice_id'=> $invoice->id
            ]);
        }

        Employee::first()->notify(new WaitingLabNotification());
        pushNotification();
    }

    public function assignTransfer(Request $request, $price)
    {
        if ($request->transfer == config('enums.transfer.doctor'))
        {
            $doctor = Doctor::find($request->doctor_id);
            $DoctorMoney  = $price * ($doctor->percentage/ 100 );
            $doctor->update([
                'wallet' => $doctor->wallet += $DoctorMoney,
                'longtime_wallet' => $doctor->lifetime_wallet += $DoctorMoney,
                'no_patients' => $doctor->no_patients += 1
            ]);
        }elseif($request->transfer == config('enums.transfer.hospital')){
            $hospital = Hospital::find($request->hospital_id);
            $hospital->update([
                'dues' => $price,
                'no_patients' => $hospital->no_patients += 1
            ]);
        }elseif($request->transfer == config('enums.transfer.contract')){
            $company_discount = (Category::find($request->category_id)->percentage / 100) * $price;
            $company = Company::find($request->company_id);
            $company->our_money += $company_discount;
            $company->save();
        }
    }

    public function transferPrice($transfer, Request $request)
    {
        $main_analysis = MainAnalysis::select('id', 'general_name', 'price', 'code')->get();
        if ($transfer == config('enums.transfer.contract')){
            $main_analysis = MainAnalysis::select('id', 'general_name', 'price_insurance as price', 'code')->get();
        }elseif ($transfer == config('enums.transfer.hospital')){
            if (isset($request->hospital_id)){
                $hospital = Hospital::find($request->hospital_id);
                $hospitalMainAnalysis = $hospital->main_analyses->map(function ($main){
                    return [
                        'id' => $main->id,
                        'general_name' => $main->general_name,
                        'price' => $main->pivot->price,
                        'code' => $main->code,
                    ];
                });
                $main_analysis = MainAnalysis::whereNotIn('id', $hospitalMainAnalysis->pluck('id')->toArray())->get()->map(function ($main){
                    return [
                        'id' => $main->id,
                        'general_name' => $main->general_name,
                        'price' => $main->price,
                        'code' => $main->code,
                    ];
                });
                $main_analysis = $main_analysis->merge($hospitalMainAnalysis);
            }else{
                $main_analysis = MainAnalysis::select('id', 'general_name', 'price', 'code')->get();
            }

        }
        return response()->json($main_analysis);
    }

    public function validator(Request $request){
        $rules = [ // basic
            "patient_id" => 'required',
            "amount_paid" => 'required_unless:pay_method,' . config('enums.payMethod.overdue'),
            "transfer" => 'required',
            "pay_method" => 'required',
            "discount" => 'nullable|numeric|min:0',
            "code_id" => 'required_if:promo_code,1',
            "hospital_id" => 'required_if:transfer,' . config('enums.transfer.hospital'),
            "sector_id" => 'required_if:transfer,' . config('enums.transfer.sector'),
            "doctor_id" => 'required_if:transfer,' . config('enums.transfer.doctor'),
            'company_id' => 'required_if:transfer,' . config('enums.transfer.contract'),
            'category_id' => 'required_if:transfer,' . config('enums.transfer.contract'),
            'policy_no' => 'required_if:transfer,' . config('enums.transfer.contract'),
            "main_analysis_id" => 'required_without:package_id', 'string', 'max:255',
        ];
        if($request->ajax()){
            $rules["amount_paid"] = 'nullable';
            $rules["pay_method"] = 'nullable';
        }
        $request->validate($rules);
    }

    public function hideAllFinished()
    {

        WaitingLab::where('result', 2)->update([
            'result' => 3
        ]);

        return redirect()->back();
    }

}
