<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\VacationType;
use Illuminate\Http\Request;

class VacationTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
   public function index(Request $request)
   {
       $this->authorize('view_leave_types');
       if ($request->ajax())
       {
           $vacation_types = VacationType::all();
           $data['data'] = $vacation_types;
           return response()->json($data);
       }
       return view('hr.vacation_types.index');
   }

   public function create()
   {
       $this->authorize('view_leave_types');
       return view('hr.vacation_types.create');
   }

   public function store(Request $request)
   {
       $this->authorize('view_leave_types');
        if ($request->ajax())
        {
            VacationType::create(
                $this->validate($request, [
                    'name'   =>'required | string',
                    'no_days'=>'required | integer',
                ])
            );

        }
   }

   public function edit(VacationType $vacationType)
   {
       $this->authorize('view_leave_types');
       return view('hr.vacation_types.edit',compact('vacationType'));
   }

   public function update(Request $request,$id)
   {
       $this->authorize('view_leave_types');
       if ($request->ajax())
       {
           VacationType::find($id)->update(
               ['name'   =>$request['name'],
                'no_days'=>$request['no_days'],
               ]);
       }
   }


}
