<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Invoice;
use App\Http\Controllers\Controller;
use App\MainAnalysis;
use App\Package;
use App\Revenue;
use App\Template;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use DNS1D;
use Setting;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee,patient,hospital');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            if (Auth::guard('hospital')->check()) {
                
                $response = Invoice::where([
                    ['hospital_id', '=', Auth::guard('hospital')->user()->id],
                    ['approved', '=', 1]
                ])->with('patient')->latest()->get();

                

            }else if (Auth::guard('patient')->check()) {

                $response = Invoice::where([
                    ['patient_id', '=', Auth::guard('patient')->user()->id],
                    ['approved', '=', 1]
                ])->with('patient')->latest()->get();

            }else if (Auth::guard('employee')->check())  {

            // $response = Invoice::with('patient')->latest()->get();

            $response = getModelData(new Invoice(), $request, ['patient' => ['name']]);

        }

        return response()->json($response);

       }
        return view('dashboard.invoices.index');

    }

    public function getInvoicesDone(Request $request)
    {
        if (Auth::guard('employee')->check())  {

            $response = getModelData(
                new Invoice(),
                $request, 
                ['patient' => ['name']],
                [['result_created','=',1], ['status', '=', 1]]);

            return response()->json($response);
        }
    }

    public function show(Request $request, Invoice $invoice)
    {
        $this->authorize('show_invoices');
        $patient = $invoice->patient;
        $promoCode = $invoice->promo_code;
        $analysisWithPromo = $promoCode->main_analysis ?? null;
        $packages = [];
        $main_analysis = [];
        if(unserialize($invoice->packages) !== null){
            $packages = Package::whereIn('id', unserialize($invoice->packages))->get();
        }
        if(unserialize($invoice->main_analysis) !== null){
            $main_analysis = MainAnalysis::whereIn('id', unserialize($invoice->main_analysis))->get();
        }
        if (isset($analysisWithPromo)){
            $promoCodeDiscount = ($analysisWithPromo->price * ($promoCode->percentage/100));
        }else{
            $promoCodeDiscount = 0;
        }
        $data = [
            'invoice'               => $invoice,
            'patient'               => $patient,
            'purchases'             => unserialize($invoice->purchases),
            'analysisWithPromo'     => $analysisWithPromo,
            'promoCode'             => $promoCode,
            'promoCodeDiscount'     => $promoCodeDiscount,
        ];
        if($request->has('print')){
            return view('dashboard.invoices.invoice_preview', $data);
        }
        return view('dashboard.invoices.show', $data);
    }

    public function discard(Request $request, $id)
    {

        if($request->ajax()){
            $invoice = Invoice::find($id);
            $waiting_labs = $invoice->waiting_labs();
            foreach ($waiting_labs as $waiting_lab) {
                $waiting_lab->results()->delete();
            }

            $waiting_labs->delete();
            $invoice->update([
                'status' => 2
            ]);

            Revenue::where('invoice_id', $invoice->id)->orWhere('serial_no', $invoice->serial_no)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Item Discarded Successfully'
            ]);

        }
    }


    public function print($id)
    {
        $invoice = Invoice::find($id);
        $template = Template::where('type', 7)->first();
        $patient = $invoice->patient;
        $paymentMethod = '';

        if($invoice->pay_method == config('enums.payMethod.cash'))
            $paymentMethod = 'نقدي :: cash';
        elseif($invoice->pay_method == config('enums.payMethod.credit'))
            $paymentMethod = 'credit :: شبكة';
        else
            $paymentMethod = 'Overdue :: مؤجل';
            
        $results = [
            'patient' => [
                'arabic_name' => $patient->name,
                'english_name' => $patient->name_in_english ?? '',
                'id_no' => $patient->id_no,
                'id' => $patient->id
            ],
            'invoice' => [
                'date' => $invoice->created_at->format('Y-m-d'),
                'time' => $invoice->created_at->format('h:iA'),
                'no' => $invoice->id,
                'serial_no' => $invoice->serial_no,
                'hospital' => $invoice->hospital->name ?? '',
                'company' => $invoice->company->name ?? '',
                'doctor' => $invoice->doctor->name ?? '',
                'policy_no' => $invoice->policy_no ?? '',
                'without_tax' => $invoice->total_price - $invoice->tax,
                'discount' =>$invoice->discount,
                'with_tax' =>$invoice->total_price,
                'amount_paid' =>$invoice->amount_paid,
                'due' =>$invoice->amount_paid - $invoice->total_price,
                'pay_method' => $paymentMethod,
                'receiver' => $invoice->employee->fullname(),
                'barcode' =>'data:image/png;base64,' . DNS1D::getBarcodePNG($invoice->barcode, 'C39',2,44,array(1,1,1), true)
            ],
            'others' => [
                'tax_no' => Setting::get('tax_no'),
            'purchase_table' => $template->purchase_table($invoice),
            ]
        ];
        $content = $template->collect_replace($results, $template->body);

        return view('dashboard.templates.print', [
           'content' => $content,
           'template' => $template
        ]);
    }



}