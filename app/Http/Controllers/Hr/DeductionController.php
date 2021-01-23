<?php

namespace App\Http\Controllers\Hr;

use App\additionDeductionTypes;
use App\Deduction;
use App\Employee;
use App\Http\Controllers\Controller;
use App\SalaryReport;
use App\Template;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_deductions');
        if($request->ajax()){
            $deductions = Deduction::with('employee')->where('type', 1)->get();
            return response()->json($deductions);
        }
        $reasons = additionDeductionTypes::where('operation_type', 1)->get();
        return view('hr.deductions.index', compact('reasons'));
    }

    public function store(Request $request)
    {
        $this->authorize('view_deductions');
        if($request->ajax()){
            $month = explode( '-',$request->effective_date)[1];
            $salary_report = SalaryReport::whereMonth('date', $month)->first();
            if (isset($salary_report)&& $salary_report->status == 2 &&$request->include == 'on'){ // لا يمكن اضافة خصم علي مسير تم اعتماده
                return response()->json([
                    'status' => false,
                    'message' => '2'
                ]);
            }elseif(isset($salary_report)&&$salary_report->status != 2 && $request->include == 'on'){ // يمكن اضافة الحسم في المسير اذا كان تحت الاجراء او غير ذلك
                $salary_report->update(['has_changes' => 1]);
                $deduction = new Deduction($this->validator($request));
                if($request->calculation == 1){ // طريقة الحسام نسبة مئوية
                    $deduction->amount = $deduction->employee->salary() * ($deduction->amount/100);
                }
                if($request->include == 'on'){
                    $deduction->payroll_status = 1;
                }
                $deduction->save();
                return response()->json([
                    'status' => true,
                ]);
            }else{
                $deduction = new Deduction($this->validator($request));
                if($request->calculation == 1){ // طريقة الحسام نسبة مئوية
                    $deduction->amount = $deduction->employee->salary() * ($deduction->amount/100);
                }
                if($request->include == 'on'){
                    $deduction->payroll_status = 1;
                }
                $deduction->save();
                return response()->json([
                    'status' => true,
                ]);
            }
        }
        return 0;
    }

    public function update(Request $request, $id)
    {
        $this->authorize('view_deductions');
        if($request->ajax()){
            Deduction::find($id)->update(['status' => 1]);
            return response()->json([
                'status' => true,
                'message' => 'Approved Successfully'
            ]);
        }
    }
    public function cancel($id , Request $request)
    {
        $this->authorize('view_deductions');
        if($request->ajax()){
            Deduction::find($id)->update(['status' => 2]);
            return response()->json([
                'status' => true,
                'message' => 'CancelLed Successfully'
            ]);
        }
    }
    public function alert_letter($id)
    {
        $this->authorize('view_deductions');
        $deduction = Deduction::find($id);
        $employee = $deduction->employee;
        $template = Template::where('type', 4)->first();
        $results = [
            'employee' => $template->employee_results($employee),
            'company' => $template->company_results(),
            'salary' => $template->salary_results($employee),
            'others' => $template->others_results(),
            'print' => $template->print_results(),
            'deduction' => ['reason' => $deduction->reason]
        ];
        $content =  $template->collect_replace($results, $template->body);
        return view('hr.printing.print',[
            'template' => $template,
            'content' =>$content
        ]);
    }
    public function validator(Request $request)
    {
        $request['status'] = 1;
        $request['type'] = 1;
        $request['effective_date'] = date( $request->effective_date . '-' . '01');
        if(!isset($request->reason) && isset($request->minutes)){
            $request['reason'] = 'late';
        }elseif(!isset($request->reason) && !isset($request->minutes)){
            $request['reason'] = 'absent';
        }
        return $this->validate($request, [
            'employee_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'reason' => 'required',
            'amount' => 'required',
            'date' => 'nullable',
            'effective_date' => 'required',
            'operational_date' => 'nullable',
            'absence_date' => 'nullable',
            'minutes' => 'nullable',
            'hours' => 'nullable',
            'notes' => 'nullable',
        ]);
    }
}
