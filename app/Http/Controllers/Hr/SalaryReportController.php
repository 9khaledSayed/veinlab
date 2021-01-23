<?php

namespace App\Http\Controllers\Hr;

use App\Addition;
use App\Deduction;
use App\Employee;
use App\Exports;
use App\Holiday;
use App\Http\Controllers\Controller;
use App\Rules\UniqueMonth;
use App\Salary;
use App\SalaryReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index()
    {
        $this->authorize('view_all_salaries');
        $salary_reports = SalaryReport::paginate(8);
        $dates          = SalaryReport::distinct('date')->pluck('date');
        $no_sal_report  = SalaryReport::all()->count();
        return view('hr.salary_reports.index', compact(['salary_reports','dates','no_sal_report']));
    }

    public function pending(Request $request)
    {
        $this->authorize('view_pending_reports');
        $pending_reports = SalaryReport::where('status', 1)->get();
        if($request->ajax()){
            return response()->json($pending_reports);
        }
        return view('hr.salary_reports.pending_reports');
    }


    public function create()
    {
        $this->authorize('view_all_salaries');
        return view('hr.salary_reports.create');
    }


    public function store(Request $request)
    {
        $this->authorize('view_all_salaries');
        $request->validate([
            'date' => new UniqueMonth
        ]);
        $request->date = date( $request->date . '-' . setting('release_day'));
        $weakly_holidays = setting('days_off');        // settings
        $month = explode('-', $request->date)[1];
        $employees = Employee::where('id','!=', 1)->get();
//        $total_loans = Loan::where('type', 3)->whereMonth('effective_date', $month)->pluck('amount')->sum();
//        $loans = Deduction::where('type', 3)->whereMonth('effective_date', $month)->pluck('amount')->sum()
        $salary_report = SalaryReport::create([
            'date'               => $request->date,
            'issue_date'         => Carbon::now()->toDateTimeString(),
            'employees_no'       => $employees->count(),
            'total_deductions'   => Deduction::where([['type', '=', 1], ['payroll_status', '=', 1], ['status','=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum(),
            'total_additions'    => Addition::where([['type', '=', 2], ['status','=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum(),
        ]);
        $monthHolidays = $this->holidays($salary_report->date) + $weakly_holidays;
        foreach ($employees as $employee) {
            if(!$employee->salaryIsSuspended($month)){
                $total_work_days = $employee->workDays($month);
                $salary_before = $total_work_days * ($employee->salary()/(30 - $monthHolidays));
                $additions = Addition::where([['employee_id', $employee->id], ['type', 2], ['status','=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum();
                $deductions = Deduction::where([['employee_id', $employee->id], ['type', 1], ['payroll_status', '=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum();
                $net_salary = $salary_before + $additions - $deductions;
                Salary::create([
                    'employee_id' => $employee->id,
                    'salary_report_id' => $salary_report->id,
                    'salary' => $salary_before,
                    'deductions' => $deductions,
                    'additions' => $additions,
                    'net_salary' => $net_salary,
                    'total_days' => $total_work_days,
                ]);
            }

        }
        $salary_report->update(['total_net_salary' => $salary_report->salaries->pluck('net_salary')->sum()]);

        return redirect(route('dashboard.hr.salary_reports.show', $salary_report));

    }

    public function show(SalaryReport $salaryReport ,Request $request)
    {
        $this->authorize('view_all_salaries');
        if($request->ajax()){
            $salaries = Salary::with(['employee', 'salary_report', 'employee.roles'])
                        ->where('salary_report_id', $salaryReport->id)->get();
            return response()->json($salaries);
        }
        return view('hr.salary_reports.show', compact('salaryReport'));
    }

    public function reissue(SalaryReport $salaryReport)
    {
        $this->authorize('view_all_salaries');
        $month = $salaryReport->date->month;
        $weakly_holidays = setting('days_off');        // settings
        $monthHolidays = $this->holidays($salaryReport->date) + $weakly_holidays;
        $employees = Employee::where('id','!=', 1)->get();
//        $total_loans = Loan::where('type', 3)->whereMonth('effective_date', $month)->pluck('amount')->sum();
        $salaryReport->update([
            'issue_date'         => Carbon::now()->toDateTimeString(),
            'employees_no'       => $employees->count(),
            'total_deductions'   => Deduction::where([['type', '=', 1], ['payroll_status', '=', 1], ['status','=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum(),
            'total_additions'    => Addition::where([['type', '=', 2], ['status','=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum(),
        ]);
        foreach ($employees as $employee) {

            if($employee->salaryIsSuspended($month)){
                Salary::where([['employee_id','=' ,$employee->id], ['salary_report_id', '=', $salaryReport->id]])->delete();
            }else{

                $total_work_days = $employee->workDays($month);
                $salary_before = $total_work_days * ($employee->salary()/(30 - $monthHolidays));
                $additions = Addition::where([['employee_id', $employee->id], ['type', 2], ['status','=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum();
                $deductions = Deduction::where([['employee_id', '=',$employee->id], ['type', '=',1], ['payroll_status', '=', 1], ['status','=', 1]])->whereMonth('effective_date', $month)->pluck('amount')->sum();
                $net_salary = $salary_before + $additions - $deductions;
                Salary::where('employee_id', $employee->id)->update([
                    'salary' => $salary_before,
                    'deductions' => $deductions,
                    'additions' => $additions,
                    'net_salary' => $net_salary,
                    'total_days' => $total_work_days,
                ]);

            }

        }
        $salaryReport->update([
            'total_net_salary' => $salaryReport->salaries->pluck('net_salary')->sum(),
            'has_changes' => 0
        ]);
        return redirect()->back()->with('reissue', 1);
    }

    public function reject(SalaryReport $salaryReport)
    {
        $this->authorize('view_all_salaries');
        $salaryReport->update([
            'status' => 3
        ]);
        return redirect()->back()->with('status', 'reject');
    }

    public function approve(SalaryReport $salaryReport)
    {
        $this->authorize('view_all_salaries');
        if($salaryReport->status ==2){
            return abort('404');
        }
        $salaryReport->update(['status' => 2]);
        // generate export with the total amount of the salary report with type
        Exports::create([
            'employee_id' => auth()->user()->id,
            'amount' => $salaryReport->total_net_salary,
            'reason' => 'Salaries',
            'type' => 5,
            'serial_no' => Exports::lastSerialNo(),
        ]);
        return redirect()->back()->with('status', 'approve');
    }

    public function cancel(SalaryReport $salaryReport)
    {
        $this->authorize('view_all_salaries');
        $salaryReport->update([
            'status' => 4
        ]);
        return redirect()->back()->with('status', 'cancel');
    }

    public function check_status($month, Request $request)
    {
        if($request->ajax()){
            $salaryReport = SalaryReport::whereMonth('date', $month)->first();
            return response()->json($salaryReport);
        }
    }

    public function holidays($date)
    {
        $month = $date->month;
        $holidays = Holiday::get();
        $days = 0;
        foreach ($holidays as $holiday) {
            if($holiday->from_date->month == $month && $holiday->to_date->month == $month){
                $days += $holiday->to_date->diffInDays($holiday->from_date);
            }elseif ($holiday->from_date->month == $month || $holiday->to_date->month == $month){
                if($holiday->from_date->month == $month && $holiday->to_date->month > $month){ // تاريخ البداية يقع في شهر المسير
                    $endOfMonth = $date->endOfMonth();
                    $date += $endOfMonth->diffInDays($holiday->from_date->month);
                }elseif($holiday->to_date->month == $month && $holiday->to_date->month < $month){ // تاريخ النهاية ييع في هذا الشهر
                    $startOfMonth = $date->startOfMonth();
                    $date += $holiday->from_date->month->diffInDays($startOfMonth);
                }
            }
       }
        return $days;
    }

}
