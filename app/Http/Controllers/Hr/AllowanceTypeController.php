<?php

namespace App\Http\Controllers\Hr;

use App\AllowanceType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllowanceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_allowances_types');
        if ($request->ajax()) {
            $allowanceTypes = AllowanceType::all();
            return response()->json($allowanceTypes);
        }
        return view('hr.allowance_types.index');
    }



    public function store(Request $request)
    {
        $this->authorize('view_allowances_types');
        if ( $request->ajax())
        {
            AllowanceType::create(
                $this->validate($request, [
                    'name'    => 'required | string',
                    'value_perc' => 'nullable | numeric',
                    'value' => 'nullable | numeric',
                    'type' => 'required | integer'
                ])
            );
        }
    }

    public function edit(AllowanceType $allowanceType)
    {
        return view('hr.allowance_types.edit',compact('allowanceType'));
    }

    public function update(AllowanceType $allowanceType , Request $request)
    {
        $this->authorize('view_allowances_types');
        if ( $request->ajax())
        {
            AllowanceType::update(
                $this->validate($request, [
                    'name'    => 'required | string',
                    'value_perc' => 'nullable | numeric',
                    'value' => 'nullable | numeric',
                    'type' => 'required | integer'
                ])
            );
        }
    }

}
