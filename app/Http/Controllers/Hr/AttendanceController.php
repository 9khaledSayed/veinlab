<?php

namespace App\Http\Controllers\Hr;

use App\HR\Attendance;
use App\Employee;
use App\HR\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Setting;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_attendance_sheet');
        if ($request->ajax()) {
            $attendance = Attendance::with('employee')->get();;
            return response()->json($attendance);
        }
        $branches = Branch::all();
        return view('hr.attendance.index',compact('branches'));
    }

    public function create()
    {
        $this->authorize('view_check_in_page');
        $employees = Employee::where('id','!=', 1)->get();
        return view('hr.attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $this->authorize('view_check_in_page');
        $admin = Employee::find(1);
        $time = date("H:i:s");;
        $employee   = Employee::find($request->employee_id);
        $attendance = $employee->attendance()->whereDate('created_at', Carbon::today())->first();
        $checked_in = isset($attendance);
        $start_time_shift = 0;
        $time_to_late = Setting::get('late_period');

        if ($employee->shift_type == 1)
        {
            $start_time_shift = Setting::get('morning_shift_start');
        }else
        {
            $start_time_shift = Setting::get('evening_shift_start');
        }

            $start_time_shift = Carbon::createFromTime($start_time_shift);
            $time_now         = Carbon::now()->format('h:iA');

        if($request->operation == 'Check in' && !$checked_in){
            Attendance::create([
                'employee_id' => $employee->id,
                'time_in' => $time,
                'day_off' => false
            ]);
            $start_time_shift->addMinutes($time_to_late);



            dd($time_now);

        if( $time_now->greaterThan($start_time_shift))
        {
                $time_late = $this->hoursandmins(($time_now->diffInMinutes($start_time_shift)), '%2d : %2d');
                $message = "الموظف " . $employee->fname_arabic . " تأخر بمقدار " . $time_late . " من الوقت";
                Notification::send($admin, new \App\Notifications\isLateNotification($employee,$message));
        }

        }else if($request->operation == 'Check out' && isset($attendance)){
            $date1 = date($attendance->time_in);
            $date2 = date($time);
            $diff = (new Carbon($attendance->time_in))->diff(new Carbon($time))->format('%h:%I:%s');
            $attendance->update([
                'time_out' => $time,
                'total_working_hours' => $diff
            ]);

            $working_hours_setting = Setting::get('working_hours');
            $working_hours         = Carbon::createFromTime($working_hours_setting);
            $time_needed = $working_hours->diffInMinutes($diff) ;

            if ($time_needed > 0)
            {

                $time = $this->hoursandmins($time_needed, '%2d : %2d');

                $message = "الموظف " . $employee->fname_arabic . " لم يكمل عدد الساعات المطلوبه بمقدار " . $time . " من الوقت";
                Notification::send($admin, new \App\Notifications\isLateNotification($employee,$message));
            }

        }else{
            return response()->json([
                'status' => false,
            ]);
        }

    }

    public function attendanceCheck($id)
    {
        $this->authorize('view_check_in_page');
        $employee = Employee::find($id);
        $attendance = $employee->attendance()->whereDate('created_at', Carbon::today())->first();
        $checked_in = isset($attendance->time_in);
        $checked_out = isset($attendance->time_out);
        if(!$checked_in){
            return response()->json(['value' => 'Check in']);
        } elseif (!$checked_out){
            return response()->json(['value' => 'Check out']);
        }else{
            return response()->json(['value' => 'Attendance and leave have been recorded']);
        }
    }

    public function myAttendance()
    {
        $this->authorize('view_my_attendance');
        return view('hr.attendance.my_attendance', [
            'my_attendance' => Attendance::where('employee_id', auth()->user()->id)->get()
            ]);
    }

    function hoursandmins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
}
