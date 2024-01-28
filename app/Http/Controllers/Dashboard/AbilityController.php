<?php

namespace App\Http\Controllers\Dashboard;

use App\Ability;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $abilities = Role::find($request->role_id)->abilities;
            return response()->json($abilities);
        }
    }
}
