<?php

namespace App\Http\Controllers\Hr;

use App\HR\Loan;
use App\Http\Controllers\Controller;
use App\HR\SalaryReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_loans');
        if($request->ajax()){
            $additions = Loan::with(['employee','employee.roles'])->where('type', 3)->get();
            return response()->json($additions);
        }
        return view('hr.loans.index');
    }

    public function store(Request $request)
    {
        $this->authorize('view_loans');
        if($request->ajax()){
            $month = explode( '-',$request->effective_date)[1];
            $salary_report = SalaryReport::whereMonth('date', $month)->first();
            if (isset($salary_report)&&$salary_report->status == 2){
                return response()->json([
                    'status' => false,
                    'message' => '2'
                ]);
            }elseif(isset($salary_report)&&$salary_report->status == 1){
                $salary_report->update(['has_changes' => 1]);
                Loan::create($this->validator($request));
                return response()->json([
                    'status' => true,
                ]);
            }else{
                if(isset($salary_report)){
                    $salary_report->update(['has_changes' => 1]);
                }
                Loan::create($this->validator($request));
                return response()->json([
                    'status' => true,
                ]);
            }
        }
        return 0;
    }

    public function update(Request $request, $id)
    {
        $this->authorize('view_loans');
        if($request->ajax()){
            Loan::find($id)->update(['status' => 1]);
            return response()->json([
                'status' => true,
                'message' => 'Approved Successfully'
            ]);
        }
    }
    public function cancel($id , Request $request)
    {
        $this->authorize('view_loans');
        if($request->ajax()){
            Loan::find($id)->update(['status' => 2]);
            return response()->json([
                'status' => true,
                'message' => 'CancelLed Successfully'
            ]);
        }
    }

    public function validator(Request $request)
    {
        $request['status'] = 1;
        $request['type'] = 3;
        $start_date = Carbon::create($request->effective_date);
        $end_date = Carbon::create($request->effective_date);
        $request['effective_date'] = $start_date;
        $request['end_date'] = $end_date->addMonth($request->num_of_months);
        return $this->validate($request, [
            'employee_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'reason' => 'required',
            'amount' => 'required|numeric',
            'date' => 'nullable|date',
            'num_of_months' => 'nullable|numeric',
            'effective_date' => 'required',
            'end_date' => 'nullable',
            'operational_date' => 'nullable',
            'absence_date' => 'nullable',
            'minutes' => 'nullable',
            'hours' => 'nullable',
            'notes' => 'nullable',
        ]);
    }
}
