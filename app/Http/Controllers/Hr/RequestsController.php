<?php

namespace App\Http\Controllers\Hr;

use App\HR\Attendance;
use App\Employee;
use App\Http\Controllers\Controller;
use App\HR\LeaveBalance;
use App\Nationality;
use App\Notifications\RequestNotification;
use App\Template;
use App\HR\VacationType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\HR\EmployeeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Setting;

class RequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function myRequests(Request $request)
    {
        $this->authorize('view_my_requests');
        if ($request->ajax()) {

            $id = Auth::guard('employee')->user()->id;

            $employee_requests = EmployeeRequest::where('employee_id',$id)->with('employee')->get();

            $data['data'] = $employee_requests;

            return response()->json($data);
        }
        return view('hr.requests.my_requests');
    }

    public function pendingRequests(Request $request)
    {
        $this->authorize('view_pending_requests');
        if ($request->ajax()) {

            $employee_requests = EmployeeRequest::where('status',2)->with('employee')->get();

            $data['data'] = $employee_requests;

            return response()->json($data);
        }
        return view('hr.requests.pending_requests');
    }

    public function finishedRequests(Request $request)
    {
        $this->authorize('view_employees_requests');
        if ($request->ajax()) {

            $employee_requests = EmployeeRequest::where('status',1)->with('employee')->get()->filter(function ($employeeRequest){
                if(isset($employeeRequest->employee)){
                    return $employeeRequest;
                }
            });

            return response()->json($employee_requests);
        }
        return view('hr.requests.finished_requests');
    }

    // start create methods //

    public function createSalaryReq()
    {
        $this->authorize('salary_induction');
        return view('hr.requests.salary_induction.create');
    }
    public function createVacationReq()
    {
        $this->authorize('vacation_request');
        $vacationTypes = VacationType::all();
        return view('hr.requests.vacations.create',compact('vacationTypes'));
    }

    public function createPermissionReq()
    {
        $this->authorize('Ask_for_permission');
        return view('hr.requests.permission.create');
    }

    public function createTripReq()
    {
        $this->authorize('Request_a_trip');
        $countries = Nationality::all();
        return view('hr.requests.trip.create',compact('countries'));
    }
    public function createDebtReq()
    {
        $this->authorize('Debt_Request');
        return view('hr.requests.debt.create');
    }
    public function createComplaintReq()
    {
        $this->authorize('Request_a_complaint');
        return view('hr.requests.complaint.create');
    }

    // end create methods //


    // start store methods //

    public function storeSalaryReq(Request $request)
    {
        $this->authorize('salary_induction');
        if ($request->ajax())
        {
            $request['type'] = 1;
            $request['employee_id'] = Auth::guard('employee')->user()->id;
            EmployeeRequest::create(
                $this->validate($request, [
                    'directed_to_ar'=>'required | string',
                    'directed_to_eng'=>'required | string',
                    'reason'=>'required | string',
                    'type' => 'integer',
                    'employee_id' => 'integer'
                ])
            );
            Employee::first()->notify(new RequestNotification());
            pushNotification();
        }
    }

    public function storeVacationReq(Request $request)
    {
        $this->authorize('vacation_request');
        if ($request->ajax())
        {
            $employee_id = Auth::guard('employee')->user()->id;
            $vacation_id = $request['vacation_id'];

            $request['type'] = 2;
            $request['employee_id'] = $employee_id;

            $to   = Carbon::createFromFormat('Y-m-d', $request["to_date"]);
            $from = Carbon::createFromFormat('Y-m-d', $request["from_date"]);
            $year = Carbon::now()->year;

            $no_days      = $to->diffInDays($from);

            if ($from->greaterThanOrEqualTo($to))
            {
                return response()->json(['errors' => "يجب أن يكون تاريخ البدايه أقل من تاريخ النهايه"]);
            }

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

            }

            EmployeeRequest::create(
                $this->validate($request, [
                    'from_date'=>'required | string',
                    'to_date'=>'required | string',
                    'vacation_id'=>'required | integer',
                    'type' => 'integer',
                    'employee_id' => 'integer'
                ])
            );

            Employee::first()->notify(new RequestNotification());
            pushNotification();

        }

    }

    public function storePermissionReq(Request $request)
    {
        $this->authorize('Ask_for_permission');
        if ($request->ajax())
        {
            $request['type'] = 3;
            $request['employee_id'] = Auth::guard('employee')->user()->id;


            EmployeeRequest::create(
                $this->validate($request, [
                    'date'=>'required | string',
                    'description' => 'required | string',
                    'type' => 'integer',
                    'employee_id' => 'integer'
                ])
            );

            Employee::first()->notify(new RequestNotification());
            pushNotification();

        }
    }

    public function storeTripReq(Request $request)
    {
        $this->authorize('Request_a_trip');
        if ($request->ajax())
        {
            $request['type'] = 4;
            $request['employee_id'] = Auth::guard('employee')->user()->id;


            EmployeeRequest::create(
                $this->validate($request, [
                    'country'=>'required | string',
                    'city'=>'required | string',
                    'description'=>'required | string',
                    'from_date' => 'required | string',
                    'to_date' => 'required | string',
                    'type' => 'integer',
                    'employee_id' => 'integer'
                ])
            );

            Employee::first()->notify(new RequestNotification());
            pushNotification();

        }
    }

    public function storeDebtReq(Request $request)
    {
        $this->authorize('Debt_Request');
        if ($request->ajax())
        {
            $request['type'] = 5;
            $request['employee_id'] = Auth::guard('employee')->user()->id;


            EmployeeRequest::create(
                $this->validate($request, [
                    'amount'=>'required | integer',
                    'no_months'=>'required | string',
                    'description'=>'required | string',
                    'date' => 'required | string',
                    'type' => 'integer',
                    'employee_id' => 'integer'
                ])
            );

            Employee::first()->notify(new RequestNotification());
            pushNotification();

        }
    }

    public function storeComplaintReq(Request $request)
    {
        $this->authorize('Request_a_complaint');
        if ($request->ajax())
        {
            $request['type'] = 6;
            $request['employee_id'] = Auth::guard('employee')->user()->id;


            EmployeeRequest::create(
                $this->validate($request, [
                    'directed_department'=>'required | string',
                    'subject'=>'required | string',
                    'description'=>'required | string',
                    'type' => 'integer',
                    'employee_id' => 'integer'
                ])
            );


            Employee::first()->notify(new RequestNotification());
            pushNotification();

        }
    }

    public function update($id,Request $request)
    {
       if ($request->ajax())
       {

           $response   = intval($request['response']);
           $comment    = $request['comment'];
           $paid       = $request['paid'];
           $employeeRequest = EmployeeRequest::find($id);
           $employee        = Employee::find($employeeRequest->employee_id);
           $request_type    =  $employeeRequest->type;

           $start_shift = null;
           $end_shift   = null;


           if ($employee->shift_type == 1)
           {
               $start_shift = Setting::get('morning_shift_start');
               $end_shift   = Setting::get('morning_shift_end');

           }else
           {
               $start_shift = Setting::get('evening_shift_start');
               $end_shift   = Setting::get('evening_shift_end');

           }

           $start_shift = Carbon::parse($start_shift);
           $end_shift   = Carbon::parse($end_shift);
           $total_working_hours = Setting::get('working_hours');
           $total_working_hours   = Carbon::createFromTime($total_working_hours);

           if ( $response == 1 )
           {
               if( $request_type == 2 )
               {
                   $from    = Carbon::createFromFormat('Y-m-d', $employeeRequest->from_date);
                   $to      = Carbon::createFromFormat('Y-m-d', $employeeRequest->to_date);
                   $year    = Carbon::now()->year;

                   $no_days = $to->diffInDays($from);

                   $x = $from;

                   if ($paid == 1)
                   {

                   for( $i = 0; $i < $no_days; $i++)
                   {
                       Attendance::create([
                           'employee_id' => $employee->id,
                           'time_in' => $start_shift,
                           'time_out' => $end_shift,
                           'total_working_hours' => $total_working_hours,
                           'day_off' => false,
                           'created_at' => $x->addDays(1)
                       ]);

                   }
                   }


                       $leave_balance = LeaveBalance::where([
                       ['employee_id' , '=' , $employeeRequest->employee_id ] ,
                       ['vacation_id' , '=' , $employeeRequest->vacation_id ]
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

                   }else
                   {
                       $vacation_no_days           = VacationType::find($employeeRequest->vacation_id)->no_days;
                       $request['no_days']         = $vacation_no_days - $no_days;
                       $request['balance']         = $request['no_days'] * (1000 / 30);
                       $request['year']            = $year;

                       LeaveBalance::create([
                               'vacation_id'     => $employeeRequest->vacation_id,
                               'employee_id'     => $employee->id,
                               'no_days'         => $request['no_days'] ,
                               'balance'         => 0,
                               'no_days_carried' => 0,
                               'year'            => $year
                       ]);

                   }
               }else if($request_type == 3 && $paid == 1)
               {
                   $date = $employeeRequest->date;

                   Attendance::create([
                       'employee_id' => $employee->id,
                       'time_in' => $start_shift,
                       'time_out' => $end_shift,
                       'total_working_hours' => $total_working_hours,
                       'day_off' => false,
                       'created_at' => $date
                   ]);

               }

               $employeeRequest->status   = 1;
               $employeeRequest->response = 1;
               $employeeRequest->comment  = $comment;
               $employeeRequest->save();

               $message = "لقد تمت الموافقه علي طلبك  من قبل الأداره !";

           }else
           {
               $employeeRequest->status   = 1;
               $employeeRequest->response = 2;
               $employeeRequest->comment  = $comment;
               $employeeRequest->save();
               $message = "لقد تم رفض طلبك من قبل الأداره !";
           }



           Notification::send($employee, new \App\Notifications\RequestResponse($message));

       }

    }

    public function delete($id)
    {
        EmployeeRequest::find($id)->delete($id);
    }

    // end store methods //

    public function salary_letter($id)
    {
        $employee = Employee::find($id);
        $template = Template::where('type', 0)->first();
        $results = [
            'employee' => $template->employee_results($employee),
            'company' => $template->company_results(),
            'salary' => $template->salary_results($employee),
            'others' => $template->others_results(),
            'print' => $template->print_results(),
        ];
        $content =  $template->collect_replace($results, $template->body);
        return view('hr.printing.print',[
            'template' => $template,
            'content' =>$content
        ]);
    }
}
