<?php

namespace App\Http\Controllers\Hr;

use App\additionDeductionTypes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdditionDeductionTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_ded_add_types');
        if ($request->ajax()) {
            $additionDeductionTypes = additionDeductionTypes::all();
            return response()->json($additionDeductionTypes);
        }
        return view('hr.adds_deds_types.index');
    }

    public function store(Request $request)
    {
        $this->authorize('view_ded_add_types');
        if ( $request->ajax())
        {
            additionDeductionTypes::create(
                $this->validate($request, [
                    'name_ar'    => 'required | string',
                    'name_en' => 'required | string',
                    'operation_type' => 'required'
                ])
            );
        }
    }

    public function edit($id)
    {
        $this->authorize('view_ded_add_types');
        $additionDeductionTypes = additionDeductionTypes::find($id);
        return view('hr.adds_deds_types.edit',compact('additionDeductionTypes'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('view_ded_add_types');
        if ($request->ajax())
        {
            additionDeductionTypes::find($id)->update(
                [   'name_ar'    => $request['name_ar'],
                    'name_en' => $request['name_en'],
                    'operation_type' => $request['operation_type']
                ]);
        }

        return view('hr.adds_deds_types.index');
    }

}
