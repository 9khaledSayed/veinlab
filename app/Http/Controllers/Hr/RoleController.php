<?php

namespace App\Http\Controllers\Hr;

use App\Ability;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $categories = [
        'employees',
        'employees_services',
        'requests',
        'vacations',
        'salaries',
        'decisions',
        'attendance',
        'memos',
        'settings'
    ];

    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_Roles');
        if($request->ajax()){
            $roles = Role::where('system', 'hr')->get();
            return response()->json($roles);
        }
        return view('hr.roles.index');
    }
    public function create()
    {
        $this->authorize('view_Roles');
        $abilities = Ability::get();
        return view('hr.roles.create' , [
            'abilities' => $abilities,
            'categories' => $this->categories
        ]);
    }
    public function store(Request $request)
    {
        $this->authorize('view_Roles');
        $role = new Role($this->validate($request, [
            'name_arabic' => 'required|string|unique:roles',
            'name_english' => 'required|string|unique:roles',
        ]));
        $role->system = 'hr';
        $role->save();
        $abilities = Ability::get();
        foreach($abilities as $ability){
            if (request($ability->name) == "on"){
                $role->allowTo($ability);
            }
        }
        return redirect(route('dashboard.hr.roles.index'));
    }
    public function show(Role $role)
    {
        $this->authorize('view_Roles');
        return view('hr.roles.show', [
            'role' => $role,
            'abilities' => Ability::get(),
            'categories' => $this->categories,
            'role_abilities' =>$role->abilities
        ]);
    }
    public function edit(Role $role)
    {
        $this->authorize('view_Roles');
        return view('hr.roles.edit', [
            'abilities' => Ability::get(),
            'categories' => $this->categories,
            'role_abilities' => $role->abilities,
            'role'  => $role
        ]);
    }
    public function update(Request $request, Role $role)
    {
        $this->authorize('view_Roles');
        if($role->name_arabic != $request->name_arabic){
            $role->update($this->validate($request, [
                'name_arabic' => 'required|string|unique:roles',
                'name_english' => 'required|string|unique:roles',
            ]));
        }
        $abilities = Ability::get();
        foreach($abilities as $ability){
            if (request($ability->name) == "on" && !$role->abilities->contains($ability)){
                $role->allowTo($ability);
            }elseif (!isset($request[$ability->name]) && $role->abilities->contains($ability)){
                $role->disallowTo($ability);
            }
        }
        return redirect(route('dashboard.hr.roles.index'));
    }

    public function destroy( Request $request , $id )
    {
        $this->authorize('view_Roles');
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
