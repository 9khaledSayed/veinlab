<?php

namespace App\Http\Controllers\Dashboard;

use App\NormalRange;
use App\Http\Controllers\Controller;
use App\SubAnalysis;
use Illuminate\Http\Request;

class NormalRangeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sub_analysis_id = $request->toArray()['query']['sub_analysis_id'];
            $normal_ranges = NormalRange::where('sub_analysis_id', $sub_analysis_id)->get();
            return response()->json($normal_ranges);
        }
    }

    public function create(Request $request)
    {
        $subAnalysis  = SubAnalysis::find($request->id);
        $index = 0;
        return view('dashboard.normal_range.create',compact('subAnalysis','index'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'gender4' => 'required',
           'from4' => 'required|min:0',
           'to4' => 'required|min:0',
           'normal4' => 'required',
        ]);
        dd($request->toArray());
        $noNormRanges = (int)  $request['number_ranges'];
        $subAnalysis = SubAnalysis::find($request->sub_analysis_id);
        $subAnalysis->normal_ranges()->delete();

        for ($i = $noNormRanges; $i >= 1 ; $i-- )
        {
            if ( $request['sub_analysis_id'] != null && $request['gender'.$i] != null && $request['from'.$i] != null && $request['to'.$i] != null && $request['normal'.$i] != null)
            {
                $normalRange = new NormalRange();
                $normalRange->sub_analysis_id  = $request['sub_analysis_id'];
                $normalRange->gender           = $request['gender'.$i];
                $normalRange->from             = $request['from'.$i];
                $normalRange->to               = $request['to'.$i];
                $normalRange->value            = $request['normal'.$i];
                $normalRange->save();
            }
        }
        return redirect(route('dashboard.sub_analysis.index'));
    }
}
