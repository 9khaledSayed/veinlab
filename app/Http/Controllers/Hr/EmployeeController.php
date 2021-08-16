<?php

namespace App\Http\Controllers\Hr;

use App\AllowanceType;
use App\Employee;
use App\HR\Branch;
use App\Http\Controllers\Controller;
use App\Nationality;
use App\Role;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public $contract_type = [
        'limited',
        'unlimited',
    ];

    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_employees');
        if ($request->ajax()){
            $search = $request->search;
            if($search == ''){
                $employees = Employee::where('id','!=', 1)->orderby('fname_arabic','asc')->select('id','fname_arabic', 'lname_arabic')->get();
            }else{
                $employees = Employee::where('id','!=', 1)->orderby('fname_arabic','asc')->select('id','fname_arabic', 'lname_arabic')->where('fname_arabic', 'like', '%' .$search . '%')->get();
            }
            return response()->json($employees);
        }
        $employees    = Employee::where('id','!=', 1)->paginate(8);
        $no_employees = Employee::where('id','!=', 1)->get()->count();
        return view('hr.employees.index', compact('employees','no_employees'));
    }


    public function create()
    {
        $this->authorize('create_employees');
        $allowances = AllowanceType::all();
        $nationalities = Nationality::all();
        $branches = Branch::all();
        $roles = Role::where('name_english', '!=', 'Hr')->get();
        $emp_num = ++Employee::withTrashed()->get()->last()->emp_num;
        while (Employee::pluck('emp_num')->contains($emp_num)){
            $emp_num = rand(1000,9999);
        }
        return view('hr.employees.create', [
            'nationalities' => $nationalities,
            'roles' => $roles,
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'branches' =>$branches,
            'emp_num'  => $emp_num
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create_employees');
        if($request->ajax()){
            $rules = Employee::$rules;
            while (Employee::withTrashed()->pluck('emp_num')->contains($request->emp_num)){
                return response()->json(array(
                    'status' => 3,
                    'message'   =>  'Employee number must be unique'
                ));;
            }
            $data = $this->validate($request, $rules);
            $data['password'] = Hash::make($request['password']);
            $employee = Employee::create($data);
            $employee->allowance_types()->attach($request->allowance);
            $role = Role::find($request->role_id);
            $employee->assignRole($role);
            $employee->assignRole(Role::where('label', 'Hr')->first());
            return response()->json([
                'status' => true,
            ]);
        }
        return 0;
    }


    public function show(Employee $employee, Request $request)
    {
        $this->authorize('show_employees');
        $branches = Branch::all();
        $allowances = $employee->allowance_types;
        if ($request->ajax()){
            return response()->json($employee);
        }
        return view('hr.employees.show', [
            'employee' => $employee,
            'nationalities' => Nationality::all(),
            'roles' => Role::all(),
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'branches' =>$branches
        ]);
    }


    public function edit(Employee $employee)
    {
        $this->authorize('Update_employees');
        $branches = Branch::all();
        $allowances = AllowanceType::all();
        $nationalities = Nationality::all();
        $roles = Role::where('name_english', '!=', 'Hr')->get();
        return view('hr.employees.edit', [
            'employee' => $employee,
            'nationalities' => $nationalities,
            'roles' => $roles,
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'branches' => $branches
        ]);
    }


    public function update(Request $request, Employee $employee)
    {
        $this->authorize('Update_employees');
        if($request->ajax()){
            $request->password = bcrypt($request->password);
            $rules = Employee::$rules;
            $rules['email'] = ($rules['email'] . ',email,' . $employee->id);
            $rules['emp_num'] = ($rules['emp_num'] . ',emp_num,' . $employee->id);
            $data = $this->validate($request, $rules);
            if (isset($request->password)){
                $data['password'] = Hash::make($request['password']);
            }

            $employee->update($data);
            $employee->allowance_types()->detach($request->allowance);
            $employee->allowance_types()->attach($request->allowance);
            $role = Role::find($request->role_id);
            $employee->roles()->detach($employee->roles);
            $employee->assignRole($role);
            $employee->assignRole(Role::where('label', 'Hr')->first());
            return response()->json([
                'status' => true,
            ]);
        }
        return 0;
    }

    public function getSalary(Request $request, $id)
    {
        if($request->ajax()){
            $salary = Employee::find($id)->basic_salary;
            return response()->json([
                'salary' => $salary
            ]);
        }
        return '';
    }

    public function operations($id)
    {
        $employee = Employee::find($id);
        $net_pay = $employee->salary() + $employee->deductions->pluck('amount')->sum() - $employee->additions->pluck('amount')->sum();
        return view('hr.employees.operations', compact(['employee', 'net_pay']));
    }


    public function destroy(Request $request, Employee $employee)
    {
        if($request->ajax())
        {
            $employee->delete();
        }
    }

    public function contract_draft($id)
    {
        $employee = Employee::find($id);
        $type = ($employee->nationality_id == 0) ? 3: 12;
        $template = Template::where('type', $type)->first();
        $results = [
            'employee' => $template->employee_results($employee),
            'company' => $template->company_results(),
            'contract' => $template->contract_results($employee),
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
