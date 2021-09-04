<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Patient;
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

    public function sendViaWhatsapp(Invoice $invoice)
    {
        $patient = $invoice->patient;
        $invoice->doctor = Auth::guard('employee')->user()->fullname();
        $invoice->approved = 1;
        $invoice->save();

        $message = "عملينا الكريم لقد تم الإنتهاء من رصد نتائج التحاليل الخاصة بك .مختبرت فين تتمنى لك السلامة .";
        $messageResponseBody =  $patient->sendWhatsappMessage($message);
        $fileResponseBody = $patient->sendWhatsappFile(route('generate_pdf', $invoice));

        if ($messageResponseBody->success || $fileResponseBody->success){
            return response('message send successfully');
        }else{
            return response('something went wrong', 404);
        }
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
