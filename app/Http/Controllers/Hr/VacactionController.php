<?php

namespace App\Http\Controllers\Hr;

use App\Attendance;
use App\Employee;
use App\Http\Controllers\Controller;
use App\LeaveBalance;
use App\VacationType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\EmployeeRequest;
use Setting;
class VacactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function myVacations(Request $request)
    {
        $this->authorize('view_my_vacations');
        if ($request->ajax()) {
            $id = Auth::guard('employee')->user()->id;
            $employee_vacations = EmployeeRequest::where([
                ['employee_id','=',$id],
                ['type','=',2]])->with('employee','vacation_type')->get();
            $data['data'] = $employee_vacations;
            return response()->json($data);
        }
        $vacation_types = VacationType::all();
        return view('hr.vacations.my_vacations',compact('vacation_types'));
    }

    public function Vacations(Request $request)
    {
        $this->authorize('view_employees_vacations');
        if ($request->ajax()) {
            $employee_vacations = EmployeeRequest::where([
                ['type','=',2],
                ['status','=',1]])->with('employee','vacation_type')->get();
            $data['data'] = $employee_vacations;
            return response()->json($data);
        }
        $vacation_types = VacationType::all();
        return view('hr.vacations.vacations',compact('vacation_types'));
    }

    public function create()
    {
        $this->authorize('create_vacations');
        $employees     = Employee::where('id','!=', 1)->get();
        $vacationTypes = VacationType::all();
        return view('hr.vacations.create',compact(['employees','vacationTypes']));
    }

    public function store(Request $request)
    {
        $this->authorize('create_vacations');
        if ($request->ajax())
        {
            $request['type'] = 2;
            $paid       = $request['paid'];
            $employee_id = intval($request['employee_id']);
            $employee    = Employee::find($employee_id);
            $vacation_id = intval($request['vacation_id']);
            $to   = Carbon::createFromFormat('Y-m-d', $request["to_date"]);
            $from = Carbon::createFromFormat('Y-m-d', $request["from_date"]);
            $year = Carbon::now()->year;
            $x    = $from;
            $no_days      = $to->diffInDays($from);
            if ($from->greaterThanOrEqualTo($to))
            {
                return response()->json(['errors' => "يجب أن يكون تاريخ البدايه أقل من تاريخ النهايه"]);
            }

            if ($employee->shift_type == 1)
            {
                $start_shift = Setting::get('morning_shift_start');
                $end_shift   = Setting::get('morning_shift_end');

            }else
            {
                $start_shift = Setting::get('evening_shift_start');
                $end_shift   = Setting::get('evening_shift_end');

            }

            $start_shift = Carbon::createFromTime($start_shift);
            $end_shift   = Carbon::createFromTime($end_shift);
            $total_working_hours = Setting::get('working_hours');
            $total_working_hours   = Carbon::createFromTime($total_working_hours);



            $employee_requests = Employee::find($employee_id)->employee_requests()->where('type',2);

            foreach($employee_requests as $employee_request)
            {

                $to_request   = Carbon::createFromFormat('Y-m-d', $employee_request->to_date);
                $from_request = Carbon::createFromFormat('Y-m-d', $employee_request->from_date);

                if (( $to->between($from_request , $to_request)  || $from->between($from_request , $to_request) ) || ( $to_request->between($from , $to)  || $from_request->between($from,$to)) || ($from->lessThan($from_request) && $to->greaterThanOrEqualTo($to_request) ) || $from->equalTo($from_request) || $to->equalTo($to_request) )
                {
                        return response()->json(['errors' => "يوجد اجازات في هذه الفتره لهذا الموظف"]);
                }

            }


            $leave_balance = LeaveBalance::where([
                ['employee_id' , '=' , $employee_id ] ,
                ['vacation_id' , '=' , $vacation_id ]
            ])->first();

            if ($leave_balance)
            {

                if ( $leave_balance->no_days < $no_days)
                {
                    return response()->json(['errors' => "أيام الاجازات المطلوبه أكبر من رصيد الموظف"]);
                }

                $new_no_days            = $leave_balance->no_days - $no_days;
                $leave_balance->no_days = $new_no_days;
                $leave_balance->balance = ( $leave_balance->no_days_carried + $new_no_days ) * (1000 / 30);
                $leave_balance->save();

                if ($paid == "on")
                {

                    for( $i = 0; $i < $no_days; $i++)
                    {
                        Attendance::create([
                            'employee_id' => $employee_id,
                            'time_in' => $start_shift,
                            'time_out' => $end_shift,
                            'total_working_hours' => $total_working_hours,
                            'day_off' => false,
                            'created_at' => $x->addDays(1)
                        ]);

                    }
                }

            }else
            {
                $vacation_no_days           = VacationType::find($vacation_id)->no_days;
                $request['no_days']         = $vacation_no_days - $no_days;
                $request['no_days_carried'] = 0;
                $request['balance']         = $request['no_days'] * (1000 / 30);
                $request['year']            = $year;

                if ( $vacation_no_days < $no_days)
                {
                    return response()->json(['errors' => "أيام الاجازات المطلوبه أكبر من رصيد الموظف"]);
                }


                LeaveBalance::create(
                    $this->validate($request,[
                        'vacation_id'     => 'required | integer',
                        'employee_id'     => 'required | integer',
                        'no_days'         => 'required | integer',
                        'balance'         => 'required | numeric',
                        'no_days_carried' => 'required',
                        'year'            => 'required'
                    ])
                );

                if ($paid == "on")
                {

                    for( $i = 0; $i < $no_days; $i++)
                    {
                        Attendance::create([
                            'employee_id' => $employee_id,
                            'time_in' => $start_shift,
                            'time_out' => $end_shift,
                            'total_working_hours' => $total_working_hours,
                            'day_off' => false,
                            'created_at' => $x->addDays(1)
                        ]);

                    }
                }

            }


            $request['status'] = 1;

            EmployeeRequest::create(
                $this->validate($request, [
                    'from_date'=>'required | string',
                    'to_date'=>'required | string',
                    'vacation_id'=>'required | integer',
                    'type' => 'required | integer',
                    'employee_id' => 'required | integer',
                    'status'    => 'required | integer'

                ])
            );

        }
    }

    public function delete($id)
    {
        EmployeeRequest::find($id)->delete($id);
    }

}
