<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\HR\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $my_salaries = Salary::with('salary_report')
            ->where('employee_id', auth()->user()->id)->get();
            return response()->json($my_salaries);
        }
        return view('hr.salaries.my_salaries');
    }

    public function show(Salary $salary, Request $request)
    {
        if($request->ajax()){
            $salary = Salary::with(['employee', 'employee.roles'])
                ->where('id', $salary->id)->firstOrFail();
            return response()->json($salary);
        }
    }
}
