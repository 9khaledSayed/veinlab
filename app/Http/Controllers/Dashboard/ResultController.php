<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Invoice;
use App\MainAnalysis;
use App\Notes;
use App\Patient;
use App\Result;
use App\Http\Controllers\Controller;
use App\SubAnalysis;
use App\Template;
use App\WaitingLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Excel;
use DNS1D;
use Illuminate\Support\Facades\Notification;

class ResultController extends Controller implements FromCollection , WithHeadings
{
    public function __construct()
    {
        $this->middleware('auth:employee,patient,hospital');
    }
    // all main result tha is has been success
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::guard('hospital')->check()){
                if(isset($request->waiting_lab_id)){
                    $response = Result::where('waiting_lab_id', $request->waiting_lab_id)->with(['sub_analysis'])->get();
                }else{
                    $response = WaitingLab::where([['status', 1], ['hospital_id', auth()->user()->id]])->with(['patient', 'main_analysis'])->get();
                }
            }
            if(Auth::guard('patient')->check()){
                if(isset($request->waiting_lab_id)){
                    $response = Result::where('waiting_lab_id', $request->waiting_lab_id)->with(['sub_analysis'])->get();
                }else{
                    $response = WaitingLab::where([['status', 1], ['patient_id', auth()->user()->id]])->with(['patient', 'main_analysis'])->get();
                }
            }
            if(isset($request->waiting_lab_id)){
                $response = Result::where('waiting_lab_id', $request->waiting_lab_id)->with(['sub_analysis'])->get();
            }else{
                $this->authorize('view_results');
                $response = WaitingLab::where('status', 2)->with(['patient', 'main_analysis'])->get();
            }
            return response()->json($response);
        }
        return view('dashboard.results.index');
    }

    public function create(Request $request)
    {
        $this->authorize('create_results');
        $waiting_lab = WaitingLab::with(['results','results.sub_analysis'])->find($request->waiting_lab_id);
        $genderType = [
            'male',
            'female',
            'child',
            'both'
        ];
        $patient = $waiting_lab->patient;
        return view('dashboard.results.create',[
            'main_analysis' => $waiting_lab->main_analysis,
            'sub_analysis'  => $waiting_lab->main_analysis->sub_analysis ,
            'gender'        => $patient->gender,
            'genderType'    => $genderType,
            'waiting_lab_id'=> $waiting_lab->id,
            'patient_id'    => $patient->id
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create_results');
        $waiting_lab = WaitingLab::with(['main_analysis', 'patient'])->find($request->waiting_lab_id);
        $sub_analysis = $waiting_lab->main_analysis->sub_analysis;
        $main_analysis = $waiting_lab->main_analysis;
        $i=0;
        foreach ($sub_analysis as $sub){
            if(isset($request->{'result_' . $sub->id})){
                Result::create([
                    'waiting_lab_id'    => $waiting_lab->id,
                    'sub_analysis_id'   => $sub->id,
                    'patient_id'        => $waiting_lab->patient->id,
                    'main_analysis_id'  => $main_analysis->id,
                    'result'            => $request->{'result_' . $sub->id},
                ]);
                ++$i;
            }
        }
        if($i>0){
            $waiting_lab->invoice->update([
                'result_created' => 1
            ]);
            $waiting_lab->update([
                'status'    => 2,
                'result'    => 2
            ]);
        }

        if(isset($request->lab_notes)){
            Notes::create([
                'main_analysis_id' => $main_analysis->id,
                'waiting_lab_id'   => $waiting_lab->id,
                'lab_notes'        => $request->lab_notes
            ]);
            $waiting_lab->invoice->update([
                'result_created' => 1
            ]);
            $waiting_lab->update([
                'status'    => 2,
                'result'    => 2
            ]);
        }
        $employee = Employee::find(1);
        Notification::send( $employee , new \App\Notifications\ResultToDoctor($waiting_lab->invoice_id , "برجاء الموافقه علي رصد نتائج مريض جديد"));
        return redirect(route('dashboard.waiting_labs.index'));

    }


    public function show($id)
    {
        $invoice = Invoice::find($id);
//        dd($invoice->toArray());
        $data = [
            'doctor' => $invoice->doctor,
            'gender' => $invoice->patient->gender,
            'patient' => $invoice->patient,
            'invoice' => $invoice,
            'waiting_labs' =>$invoice->waiting_labs
        ];
        return view('dashboard.results.show', $data);
    }

    public function edit(WaitingLab $waitingLab)
    {
        $this->authorize('update_results');
        $genderType = ['male', 'female', 'child', 'both'];
        return view('dashboard.results.edit',[
            'main_analysis'  => $waitingLab->main_analysis,
            'results'        => $waitingLab->results ,
            'sub_analysis'   => $waitingLab->main_analysis->sub_analysis,
            'gender'         => $waitingLab->patient->gender,
            'waiting_lab'    => $waitingLab,
            'notes'          => $waitingLab->notes,
            'genderType'     => $genderType,
            'index'     => 0
        ]);

    }



    public function update(Request $request, $waiting_lab_id)
    {
        $this->authorize('update_results');
        $waiting_lab = WaitingLab::with(['main_analysis','results', 'patient', 'notes'])->find($waiting_lab_id);
        $main_analysis = $waiting_lab->main_analysis;
        $i = $waiting_lab->results->count();
        $sub_analysis = $main_analysis->sub_analysis;
        foreach ($sub_analysis as $sub){
            $result = null;
            if($waiting_lab->results->map->sub_analysis->contains($sub)){
                $result = $waiting_lab->results->where('sub_analysis_id', $sub->id)->first();
            };
            if(isset($result) && !isset($request->{'result_' . $sub->id})){
                $result->delete();
                --$i;
            }elseif(isset($result)){
                $result->update([
                    'result' => $request->{'result_' . $sub->id}
                ]);
            }elseif(isset($request->{'result_' . $sub->id})){
                Result::create([
                    'waiting_lab_id'    => $waiting_lab->id,
                    'sub_analysis_id'   => $sub->id,
                    'patient_id'        => $waiting_lab->patient->id,
                    'main_analysis_id'  => $main_analysis->id,
                    'result'            => $request->{'result_' . $sub->id},
                ]);
                ++$i;
            }
        }

        if (isset($waiting_lab->notes)){
            $waiting_lab->notes->update([
                'lab_notes' =>$request->lab_notes
            ]);
        }elseif(isset($request->lab_notes)){
            Notes::create([
                'main_analysis_id' => $main_analysis->id,
                'waiting_lab_id'   => $waiting_lab->id,
                'lab_notes'        => $request->lab_notes
            ]);
        }
        if($i<=0 && !isset($waiting_lab->notes)){
            $waiting_lab->update([
                'status'    => 1,
                'result'    => 1
            ]);
        }
        $employee = Employee::find(1);
        Notification::send( $employee , new \App\Notifications\ResultToDoctor($waiting_lab->invoice_id , "تم تعديل النتائج المطلوبه"));
        return redirect()->back()->with('message', 'done!');

    }




    public function collection()
    {
        $result = Result::select('name','our_money','created_at')->get();
        return $result;
    }

    public function print($id)
    {
        $invoice = Invoice::find($id);
        $patient = $invoice->patient;
        $template = Template::where('type', 8)->first();
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
            'analysis' => ['analysis_results_tables' => $template->analysis_results_tables($invoice)],
            'invoice' => [
                'date' => $invoice->created_at->format('Y-m-d'),
                'time' => $invoice->created_at->format('h:iA'),
                'no' => $invoice->id,
                'serial_no' => $invoice->serial_no,
                'hospital' => $invoice->hospital->name ?? '',
                'company' => $invoice->company->name ?? '',
                'doctor' => $invoice->doctor ?? '',
                'policy_no' => $invoice->policy_no ?? '',
                'without_tax' => $invoice->total_price - $invoice->tax,
                'discount' =>$invoice->discount,
                'with_tax' =>$invoice->total_price,
                'amount_paid' =>$invoice->amount_paid,
                'due' =>$invoice->amount_paid - $invoice->total_price,
                'pay_method' =>$paymentMethod,
                'barcode' =>'data:image/png;base64,' . DNS1D::getBarcodePNG($invoice->barcode, 'C39',2,44,array(1,1,1), true)
            ],
        ];
        $content = $template->collect_replace($results, $template->body);

        return view('dashboard.templates.print', [
            'content' => $content,
            'template' => $template
        ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Our Money',
            'Date'
        ];
    }

    public function export()
    {
        return Excel::download(new ResultController() , 'النتائج.xls');
    }

}


