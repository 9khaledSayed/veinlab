<?php

namespace App\Http\Controllers\Hr;

use App\HR\Decision;
use App\Employee;
use App\Http\Controllers\Controller;

use App\Nationality;
use App\HR\SalaryReport;
use App\Template;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DecisionController extends Controller
{

    public $reasons=[
        'The term of the contract expires, or the parties agree to terminate the contract', // 0 ==> case1
        'worker resigned',// 1 ==> case2
        'The contract was terminated by the employer of one of the cases contained in Article (80)', // 2 ==> case3
        'Termination of the contract from the employer',// 3 ==> case4
        'Leaving work is the result of a force majeure',// 4 ==> case1
        'Leaving the worker in a case in article 81',// 5 ==> case1
        'Termination of employment within six months of the marriage contract Or within three months of the situation',// 6 ==> case1
        'The worker left without resignation other than the cases described in Article (81)',// 7 ==> case3
        'Termination by the worker or leaving the worker to work for a non-worker Situations in article (81)'// 8 ==> case3
    ];
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function my_decisions(Request $request)
    {
        $this->authorize('view_my_decisions');
        if($request->ajax()){
            $decisions = Decision::with('employee')->where('created_by', auth()->user()->id)->get();
            return response()->json($decisions);
        }
        return view('hr.decisions.my_decisions');
    }
    public function all_decisions(Request $request)
    {
        $this->authorize('view_all_decisions');
        if($request->ajax()){
            $decisions = Decision::with('employee')->get();
            return response()->json($decisions);
        }
        return view('hr.decisions.all_decisions');
    }
    public function terminated_employees(Request $request)
    {
        $this->authorize('view_terminated_employees');
        if($request->ajax()){
            $terminated_decision = Decision::with('employee')->where('type', 1)->get();
            return response()->json($terminated_decision);
        }
        return view('hr.decisions.terminated_employees');
    }
    public function terminate_employee(Request $request)
    {
        $this->authorize('view_terminated_employees');
        return view('hr.decisions.terminate_employee', ['reasons' => $this->reasons]);

    }
    public function show_terminated_employee($id)
    {
        $this->authorize('view_terminated_employees');
        $decision = Decision::with('employee')->find($id);
        return view('hr.decisions.show_terminated_employee',compact('decision'));
    }

    public function terminated_cancel($id, Request $request)
    {
        $this->authorize('view_terminated_employees');
        $employee = Employee::onlyTrashed()->where('id', $id)->restore();
        $decision = Decision::find($request->decision_id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Employee Termination has been cancelled'
        ]);
    }

    public function suspended_employees(Request $request)
    {
        $this->authorize('view_suspended_salaries');
        if($request->ajax()){
            $suspended_decisions = Decision::with('employee')->where('type', 2)->get();
            return response()->json($suspended_decisions);
        }
        return view('hr.decisions.suspended_employees');
    }
    public function show_suspend_employee($id, Request $request)
    {
        $this->authorize('view_suspended_salaries');
        if($request->ajax()){
            $decision = Decision::with('employee')->find($id);
            return response()->json($decision);
        }
        return view('hr.decisions.suspended_employees');
    }
    public function suspend_employee(Request $request)
    {
        $this->authorize('view_suspended_salaries');
        if($request->isMethod('post')){
            if(isset($request->sus_from_date) && isset($request->sus_end_date)){
                $start = Carbon::create($request->sus_from_date);
                $end = Carbon::create($request->sus_end_date);
                if($end < $start ){
                    return response()->json([
                        'date' => false,
                    ]);
                }
            }
            $decision = Decision::create([
                'employee_id' => $request->employee_id,
                'from_date' => $request->sus_from_date . '-01',
                'to_date' => isset($request->sus_end_date) ? $request->sus_end_date . '-01': null,
                'type' => '2',    // Suspend Salary
                'notes' => $request->notes,    // Suspend Salary
            ]);
            for($i = $decision->from_date->month; $i<= $decision->to_date->month;$i++){
                $report = SalaryReport::whereMonth('date', $i)->first();
                if(isset($report)){
                    $report->update([
                        'has_changes' => 1
                    ]);
                }
            }
            return response()->json([
                'status' => false,
            ]);
        }
        return view('hr.decisions.suspend_employee');
    }

    public function suspend_approve($id)
    {
        $this->authorize('view_suspended_salaries');
        Decision::find($id)->update([
            'status' => 1
        ]);

        return redirect()->back();
    }
    public function suspend_cancel($id)
    {
        $this->authorize('view_suspended_salaries');
        Decision::find($id)->update([
            'status' => 2
        ]);

        return redirect()->back();
    }


    public function end_service_reward(Request $request)
    {
        $this->authorize('view_terminated_employees');
        $employee = Employee::find($request->employee_id);
        $duration = $employee->duration($request->termination_date);
        $total_salary = $employee->basic_salary; // add allowness
        $leave_days = $employee->leave_balances->pluck('no_days_carried')->sum();
        $entitlements = $leave_days * $employee->salary()/30;
        $obligations = $employee->deductions->where('payroll_status', 1)->where('status',1)->pluck('amount')->sum();

        if(in_array($request->termination_reason, [0,4,5,6])){
            $end_of_service = $this->case1($duration, $total_salary);
        }elseif ($request->termination_reason == 1){
            $end_of_service = $this->case2($duration, $total_salary);
        }elseif (in_array($request->termination_reason, [2,7,8])){
            $end_of_service = $this->case3($duration, $total_salary);
        }elseif ($request->termination_reason == 3){
            $end_of_service = $this->case4($duration, $total_salary, $employee, $request->termination_date);
        }
        $total_amount = $end_of_service + $entitlements - $obligations;
        $result = [
            "emp_num" => $employee->emp_num,
            "emp_name" => $employee->fname_arabic . ' ' . $employee->lname_arabic,
            "emp_joined_date" => $employee->joined_date->format("Y-m-d"),
            "years" => $duration['years'],
            "months" => $duration['months'],
            "days" => $duration['days'],
            "service_reward" => $end_of_service,
            "leave_days" => $leave_days,
            "entitlements" => $entitlements,
            "obligations" => $obligations,
            "total" => $total_amount,
        ];
        if($request->ajax()){
            return response()->json($result);
        }else{
            $decision = Decision::create([
                'termination_date' => $request->termination_date,
                'end_of_service' => $end_of_service,
                'entitlements' => $entitlements,
                'obligations' => $obligations,
                'termination_reason' => $this->reasons[$request->termination_reason],
                'termination_notes' => $request->notes,
                'employee_id' => $request->employee_id,
                'type' => '1',    // terminate employee
            ]);
            $employee->delete();
            return view('hr.decisions.terminated_employees');
        }


    }

    public function case1($duration, $total_salary)
    {
        $end_of_service = 0;
        if($duration['years'] > 5 ){
            $yearsAfter5 = $duration['years'] - 5;
            $end_of_service += ($total_salary/2) * 5;   // نصف الراتب في حالة الخمس سنوات
            $end_of_service += ($total_salary) * $yearsAfter5; //  المرتب كامل في حالة اكثر من خمس سنوات
        }else{
            $total_salary/=2;
            $end_of_service += $total_salary * $duration['years'];
        }
        $monthsReward = ($total_salary / 12) * $duration['months'];
        $daysReward = ($total_salary / (12 * 30)) * $duration['days'];
        $end_of_service += ($monthsReward + $daysReward);
        return $end_of_service;
    }

    public function case2($duration, $total_salary)
    {
        $end_of_service = 0;
        if($duration['years'] < 2){ // لا يستحق مكافاة
            return $end_of_service; //0
        }
        $end_of_service = $this->case1($duration, $total_salary);
        if($duration['years'] >= 2 &&  $duration['years'] <=5){ //  يستحق ثلث المكافاة
            $end_of_service = $end_of_service/3;
        }elseif($duration['years'] >= 6 &&  $duration['years'] <10){//  يستحق ثلثين المكافاة
            $end_of_service = ($end_of_service/3) * 2;
        }   // المكافاة كاملة من 10 سنوات الي اكثر

        return $end_of_service;
    }

    public function case3()
    {
        return 0;
    }

    public function case4($duration, $total_salary, Employee $employee, $termination_date)
    {
        $end_of_service = 0;
        if($employee->contract_type == 1){
            $end_of_service = $this->case1($duration, $total_salary);
            $contract_end_date = $employee->start_date->addMonth($employee->contract_period);
            $months_due = $contract_end_date->diffInMonths($termination_date) * $total_salary;
            $end_of_service += $months_due;
        }else {
            $end_of_service = $this->case1($duration, $total_salary);
        }
        return $end_of_service;
    }

    public function service_settlement($id)
    {
        $this->authorize('view_terminated_employees');
        $decision = Decision::find($id);
        $template = Template::where('type', 1)->first();
//        dd($template->decision_results($decision));
        $content =  $template->collect_replace($template->decision_results($decision), $template->body);
        return view('hr.printing.print',[
            'template' => $template,
            'content' =>$content
        ]);
    }
    public function service_certificate($id)
    {
        $this->authorize('view_terminated_employees');
        $decision = Decision::find($id);
        $template = Template::where('type', 2)->first();
        $content =  $template->collect_replace($template->decision_results($decision), $template->body);
        return view('hr.printing.print',[
            'template' => $template,
            'content' =>$content
        ]);
    }

}


