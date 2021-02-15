<?php

namespace App\Http\Controllers\Hr;

use App\HR\Addition;
use App\additionDeductionTypes;
use App\Http\Controllers\Controller;
use App\HR\SalaryReport;
use Illuminate\Http\Request;

class AdditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_additions');
        if($request->ajax()){
            $additions = Addition::with('employee')->where('type', 2)->get();
            return response()->json($additions);
        }
        $reasons = additionDeductionTypes::where('operation_type', '2')->get();
        return view('hr.additions.index', compact('reasons'));
    }

    public function store(Request $request)
    {
        $this->authorize('view_additions');
        if($request->ajax()){
            $month = explode( '-',$request->effective_date)[1];
            $salary_report = SalaryReport::whereMonth('date', $month)->first();
            if (isset($salary_report)&&$salary_report->status == 2){
                return response()->json([
                    'status' => false,
                    'message' => '2'
                ]);
            }elseif(isset($salary_report)&&$salary_report->status != 2){
                $salary_report->update(['has_changes' => 1]);
                Addition::create($this->validator($request));
                return response()->json([
                    'status' => true,
                ]);
            }else{
                Addition::create($this->validator($request));
                return response()->json([
                    'status' => true,
                ]);
            }
        }
        return 0;
    }

    public function update(Request $request, $id)
    {
        $this->authorize('view_additions');
        if($request->ajax()){
            Addition::find($id)->update(['status' => 1]);
            return response()->json([
                'status' => true,
                'message' => 'Approved Successfully'
            ]);
        }
    }
    public function cancel($id , Request $request)
    {
        $this->authorize('view_additions');
        if($request->ajax()){
            Addition::find($id)->update(['status' => 2]);
            return response()->json([
                'status' => true,
                'message' => 'CancelLed Successfully'
            ]);
        }
    }

    public function validator(Request $request)
    {
        $request['status'] = 1;
        $request['type'] = 2;
        $request['effective_date'] = date( $request->effective_date . '-' . '01');
        if(!isset($request->reason) && isset($request->minutes)){
            $request['reason'] = 'Overtime';
        }
        return $this->validate($request, [
            'employee_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'reason' => 'required',
            'amount' => 'required|numeric',
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
