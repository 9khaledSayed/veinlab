<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SnappyPDF;
use App\Template;
use App\WaitingLab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\In;
use DNS1D;
use PDFNik;
use App;
use Illuminate\Support\Facades\Redirect;

class SendResultController extends Controller
{
//    public function store(Request $request)
//    {
//        $patient_id   = $request->patient_id;
//        $invoice_id   = $request->invoice_id;
//
//        $data = $this->getResult($invoice_id);
//
//        $pdf  = App::make('snappy.pdf.wrapper');
//        $pdf->setOption('no-stop-slow-scripts', true);
//        $pdf->loadView('dashboard.results.pdf', $data);
//        $path = 'public/results/result_'.$patient_id.$invoice_id.'.pdf';
//        $filename = base_path($path);
//        $pdf->save($filename);
//
//        $invoice = Invoice::find($invoice_id);
//        $invoice->doctor = Auth::guard('employee')->user()->name;
//        $invoice->approved = 1;
//        $invoice->save();
//
//        $patient   = Patient::find($patient_id);
//
//
//        $analysis_url = "http://veinlab.net/dashboard/results/" . $invoice_id;
//
//        Notification::send( $patient , new \App\Notifications\ResultReady($analysis_url,$patient));
//
//        return Redirect::to('https://www.hiwhats.com/index.php?url=API/send&mobile=966554121213&password=446c8f5d3&instanceid=19239&message=ahmad gamal&numbers=201007949946&json=1&fileurl=http://www.veinlab.net/'.$path.'&type=2');
//        //return Redirect::to('https://www.hiwhats.com/API/send?mobile=966554121213&password=446c8f5d3&instanceid=19239&message=test&numbers=966554121213&json=1&type=2&fileurl=https://unsplash.com/photos/SYTO3xs06fU.jpg');
//
//    }



    public function sendViaWhatsapp(Invoice $invoice)
    {
        $patient = $invoice->patient;
        $invoice->doctor = Auth::guard('employee')->user()->fullname();
        $invoice->approved = 1;
        $invoice->save();

        $this->SendPdf($invoice);

        return Redirect::to('https://hiwhats.com/API/send?mobile=966554121213&password=446c8f5d3&instanceid=19239&message=لقد تم الأنتهاء من رصد النتائج الخاصة بك مختبرات فين تتمني لك الشفاء العاجل باذت الله&numbers=201024098963&json=1&type=1');

    }

    public function SendPdf($invoice)
    {


        $data = $this->getResult($invoice->id);

        $pdf  = App::make('snappy.pdf.wrapper');
        $pdf->loadView('dashboard.results.pdf', $data);
        $path = 'public/results/result_'. $invoice->patient_id . $invoice->id.'.pdf';
        $filename = base_path($path);
        $pdf->save($filename);

        return Redirect::to('https://www.hiwhats.com/index.php?url=API/send&mobile=966554121213&password=446c8f5d3&instanceid=19239&message=ahmad gamal&numbers=201007949946&json=1&fileurl=http://www.veinlab.net/'.$path.'&type=2');

    }

    public function getResult($invoice_id)
    {

        $waiting_labs = Invoice::find($invoice_id)->waiting_labs;
        $doctor       = Invoice::find($invoice_id)->doctor;

        $genderType = [
            'male',
            'female',
            'child',
            'both'
        ];

        $waitingLab_ids =  array();
        $results        =  array();
        $main_analysis  =  array();
        $notes          =  array();


        for($i = 0; $i < sizeof($waiting_labs) ; $i++)
        {
            $waitingLab_ids[$i]    = $waiting_labs[$i]->id;
            $results[$i]       = $waiting_labs[$i]->results;
            $main_analysis[$i] = $waiting_labs[$i]->main_analysis->general_name;
            $notes[$i]         = $waiting_labs[$i]->notes->lab_notes ?? '';

        }

        $data = [
            'waitingLab_ids' => $waitingLab_ids,
            'doctor'         => $doctor,
            'results'        => $results,
            'main_analysis'  => $main_analysis,
            'genderType'     => $genderType,
            'gender'         => $waiting_labs[0]->patient->gender,
            'notes'          => $notes,
            'patient'        => $waiting_labs[0]->patient,
            'invoice'     => $waiting_labs[0]->invoice,
            'index'           => -1
        ];

        return $data;


        // $messageResponseBody =  $patient->sendWhatsappMessage(setting('whatsapp_result_msg'));
        // $fileResponseBody = $patient->sendWhatsappFile(route('generate_pdf', $invoice));

        // if ($messageResponseBody->success || $fileResponseBody->success){
        //     return response('message send successfully');
        // }else{
        //     return response('something went wrong', 404);
        // }
    }

    public function sendViaEmail(Invoice $invoice)
    {
        $patient = $invoice->patient;
        $patient->notify(new App\Notifications\ResultReady($patient, $invoice->id, ['mail']));

        return response()->json([
            'success' => true
        ]);
    }

    public function sendViaWebNotification(Invoice $invoice)
    {
        $patient = $invoice->patient;
        $patient->notify(new App\Notifications\ResultReady($patient, $invoice->id, ['database']));
        pushNotification($patient);

        return response()->json([
            'success' => true
        ]);
    }


    public function generatePdf($id)
    {
        $invoice = Invoice::withTrashed()->find($id);
        $patient = $invoice->patient;

        $pdf = PDFNik::loadView('dashboard.templates.pdf.result_pdf', [
            'invoice' => $invoice,
            'patient' => $patient,
        ]);

        return $pdf->stream('Results.pdf');
    }



}
