<?php

namespace App\Http\Controllers\Dashboard;

use App\Ability;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $captions  = [
        'roles',
        'hospitals',
        'doctors',
        'companies',
        'patients',
        'results',
        'main_analysis',
        'sub_analysis',
        'waiting_labs',
        'notifications',
        'home_visits',
        'packages',
        'promo_codes',
        'stocks',
        'invoices',
        'nationalities',
        'exports',
        'revenue',
        'profits',
        'reports',
        'statistics',
        'sittings',
    ];
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_roles');
        if($request->ajax()){
            $roles = Role::where('system', 'lab')->get();
            return response()->json($roles);
        }
        return view('dashboard.roles.index');
    }


    public function create()
    {
        $this->authorize('create_roles');
        return view('dashboard.roles.create' , [
            'abilities' => Ability::get(),
            'captions'  => $this->captions
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create_roles');
        $role = new Role($this->validate($request, [
            'name_arabic' => 'required|string|unique:roles',
            'name_english' => 'required|string|unique:roles',
        ]));
        $role->system = 'lab';
        $role->save();
        $abilities = Ability::get();
        foreach($abilities as $ability){
            if (request($ability->name) == "on"){
                $role->allowTo($ability);
            }
        }
        return redirect(route('dashboard.roles.index'));
    }


    public function show(Role $role)
    {
        $this->authorize('show_roles');
        return view('dashboard.roles.show', [
            'role'=> $role,
            'abilities'=> Ability::get(),
            'captions'=> $this->captions,
            'role_abilities'=> $role->abilities
        ]);
    }


    public function edit(Role $role)
    {
        $this->authorize('update_roles');
        $abilities = Ability::get();
        $role_abilities = $role->abilities;
        $captions  = $this->captions;
        return view('dashboard.roles.edit', compact(['role','abilities', 'captions', 'role_abilities']));
    }


    public function update(Request $request, Role $role)
    {
        $this->authorize('update_roles');
        $role->update($this->validate($request, [
            'name_arabic' => 'required|string|unique:roles,id,' . $role->id,
            'name_english' => 'required|string|unique:roles,id,' . $role->id
        ]));
        $abilities = Ability::get();
        foreach($abilities as $ability){
            if (request($ability->name) == "on" && !$role->abilities->contains($ability)){
                $role->allowTo($ability);
            }elseif (!isset($request[$ability->name]) && $role->abilities->contains($ability)){
                $role->disallowTo($ability);
            }
        }
        return redirect(route('dashboard.roles.index'));
    }

    public function assigned_employees(Request $request)
    {
        $this->authorize('create_roles');
        if($request->ajax()){
            $employees = Employee::with('branch')->get();
            return response($employees);
        }

        return view('dashboard.roles.assigned_employees');

    }

    public function assigned_roles(Request $request, $id)
    {
        if($request->ajax()){
            $roles = Employee::find($id)->roles;
            return response()->json($roles);
        }
        return view('errors.404-error');
    }

    public function create_assignment(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'employee_id' => 'required',
                'role_ids' => 'required'
            ]);
           $employee = Employee::find($request->employee_id);
            foreach ($request->role_ids as $role_id) {
                $employee->assignRole(Role::find($role_id));
           }
            return redirect(route('dashboard.roles.assigned_employees'));
        }
        return view('dashboard.roles.create_assignment', [
            'employees' => Employee::get(),
            'roles' => Role::get()
        ]);
    }

    public function edit_assignment($id , Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'role_ids' => 'required',
            ]);
            $employee = Employee::find($id);
            foreach ($request->role_ids as $role_id) {
                $employee->assignRole(Role::find($role_id));
            }
            return redirect(route('dashboard.roles.assigned_employees'));
        }
        return view('dashboard.roles.edit_assignment', [
            'item' => Employee::find($id),
            'employees' => Employee::get(),
            'roles' => Role::get()
        ]);
    }

    public function destroy( Request $request , $id )
    {
        $this->authorize('delete_roles');
        $role = Role::find($id);
        if($request->ajax() && $role->type != 1){
            $role->delete();
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Can\'t Delete System Role'
            ]);
        }

    }
}
