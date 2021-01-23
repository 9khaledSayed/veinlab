<?php

namespace App\Http\Controllers\Hr;

use App\Holiday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_holidays');
        if($request->ajax()){
            $holidays = Holiday::get();
            return response($holidays);
        }
        return view('hr.holidays.index');
    }

    public function create()
    {
        $this->authorize('view_holidays');
        return view('hr.holidays.create');
    }

    public function store(Request $request)
    {
        $this->authorize('view_holidays');
        Holiday::create($this->validate($request,[
            'name_arabic' => 'required|string',
            'name_english' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]));
    }



    public function edit(Holiday $holiday)
    {
        $this->authorize('view_holidays');
        return view('hr.holidays.edit', compact('holiday'));
    }


    public function update(Request $request, Holiday $holiday)
    {
        $this->authorize('view_holidays');
        $holiday->update($this->validate($request,[
            'name_arabic' => 'required|string',
            'name_english' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]));
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('view_holidays');
        if($request->ajax()){
            Holiday::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
    }
}
