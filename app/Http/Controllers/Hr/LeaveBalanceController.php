<?php

namespace App\Http\Controllers\Hr;

use App\Employee;
use App\Http\Controllers\Controller;
use App\HR\LeaveBalance;
use App\HR\VacationType;
use Illuminate\Http\Request;

class LeaveBalanceController extends Controller
{
        public function index(Request $request)
        {
            $this->authorize('view_vacations_Balances');
            if ($request->ajax()) {

                $vacations_balances = LeaveBalance::with('employee','vacation_type')->get()->filter(function ($vacationsBalances){
                    if(isset($vacationsBalances->employee)){
                        return $vacationsBalances;
                    }else{
                        $vacationsBalances->delete();
                    }
                });

                return response()->json($vacations_balances);
            }

            $vacation_types = VacationType::all();
            $years          = LeaveBalance::distinct('year')->plucK('year');
            return view('hr.vacations.vacations_balances',compact('vacation_types','years'));
        }

        public function create()
        {
            $this->authorize('create_vacations');
            $employees = Employee::all();
            return view('hr.vacations.create',compact('employees'));
        }

        public function store(Request $request)
        {
            $this->authorize('create_vacations');
            if ($request->ajax()) {

                $vacations_balances = LeaveBalance::with('employee')->get();

                $data['data'] = $vacations_balances;

                return response()->json($data);
            }
            return view('hr.vacations.vacations_balances');
        }

        public function getLeaveBalance(Request $request)
        {
            $employee_id = intval($request['employee_id']);
            $vacation_id = intval($request['vacation_id']);

            $leave_balance = LeaveBalance::where([
                ['employee_id' , '=' , $employee_id ] ,
                ['vacation_id' , '=' , $vacation_id ]
            ])->first();
            if (! $leave_balance)
            {
                $vacationTypeDays = VacationType::find($vacation_id)->no_days;
                $leave_balance['no_days'] = $vacationTypeDays;
            }
            return response()->json($leave_balance);
        }

}
