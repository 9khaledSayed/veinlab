<?php

namespace App\Http\Controllers\Dashboard;

use App\MainAnalysis;
use App\Http\Controllers\Controller;
use App\Role;
use App\SubAnalysis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Excel;

class MainAnalysisController extends Controller implements  FromCollection, WithHeadings
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_main_analysis');
        if ($request->ajax()) {
            $analysis = MainAnalysis::get();
            return response()->json($analysis);
        }
        $isSuperAdmin = auth()->user()->roles->contains(Role::where('label', 'Super Admin')->firstOrFail());
        $isLab = auth()->user()->roles->contains(Role::where('label', 'Lab')->firstOrFail());
        return view('dashboard.main_analysis.index', compact(['isLab', 'isSuperAdmin']));
    }

    public function create()
    {
        $this->authorize('create_main_analysis');
        return view('dashboard.main_analysis.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create_main_analysis');

        $rules = MainAnalysis::$rules;

        $mainAnalysis = MainAnalysis::create($this->validate($request,$rules));

        $noSubAnalysis = (int)  $request['number_sub_analysis'];

        for ($i = $noSubAnalysis; $i >= 1 ; $i-- )
        {

            if ( $request['sub_analysis'.$i] != null || $request['unit'.$i] != null )
            {
                $subAnalysis = new SubAnalysis();
                $subAnalysis->main_analysis_id = $mainAnalysis->id;
                $subAnalysis->name             = $request['sub_analysis'.$i];
                $subAnalysis->unit             = $request['unit'.$i];
                $subAnalysis->save();
            }

        }



        return redirect(route('dashboard.main_analysis.index'));
    }

    public function show($id)
    {
        $this->authorize('show_main_analysis');
        $main_analysis = MainAnalysis::find($id);
        return view('dashboard.main_analysis.show', compact('main_analysis'));
    }

    public function edit($id)
    {
        $this->authorize('update_main_analysis');
        $main_analysis = MainAnalysis::find($id);
        $count  = 0;
        return view('dashboard.main_analysis.edit', compact('main_analysis','count'));
    }


    public function update(Request $request, $id)
    {

        $this->authorize('update_main_analysis');

        $rules = MainAnalysis::$rules;
        $rules['code'] = ( $rules['code'] . ',code,' . $id ) ;

        $main_analysis = MainAnalysis::find($id);
        $main_analysis->update($this->validate($request,$rules));

        $main_analysis->sub_analysis()->delete();

        $noSubAnalysis = (int)  $request['number_sub_analysis'];


        for ($i = $noSubAnalysis; $i >= 1 ; $i-- )
        {

            if ( $request['sub_analysis'.$i] != null || $request['unit'.$i] != null )
            {
                $subAnalysis = new SubAnalysis();
                $subAnalysis->main_analysis_id = $main_analysis->id;
                $subAnalysis->name             = $request['sub_analysis'.$i];
                $subAnalysis->unit             = $request['unit'.$i];
                $subAnalysis->save();
            }

        }



        return redirect(route('dashboard.main_analysis.index'));
    }


    public function destroy($id ,Request $request)
    {
        $this->authorize('delete_main_analysis');
        if($request->ajax()){

            MainAnalysis::find($id)->destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.main_analysis.index'));
    }

    public function report(Request $request)
    {
        $this->authorize('view_reports');
        if(isset($request->date)){
            $date = Carbon::create($request->date);
            $main_analysis = MainAnalysis::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $total_amount = $main_analysis->pluck('price')->sum();
            $total_cost = $main_analysis->pluck('cost')->sum();
            $total_profits = $main_analysis->map(function ($analysis) {
                return ($analysis->demand_no * $analysis->price) - ($analysis->demand_no * $analysis->cost);
            })->sum();
            return view('dashboard.main_analysis.report', compact(['main_analysis', 'total_amount', 'total_cost', 'total_profits', 'date']));
        }
        $main_analysis = MainAnalysis::get();
        $total_amount = $main_analysis->pluck('price')->sum();
        $total_cost = $main_analysis->pluck('cost')->sum();
        $total_profits = $main_analysis->map(function ($analysis) {
            return ($analysis->demand_no * $analysis->price) - ($analysis->demand_no * $analysis->cost);
        })->sum();
        return view('dashboard.main_analysis.report', compact(['main_analysis', 'total_amount', 'total_cost', 'total_profits']));

    }


    public function export()
    {
        return Excel::download(new MainAnalysisController() , 'التحاليل الرئيسيه.xls');
    }

    public function collection()
    {

        $main_analysis = MainAnalysis::select('general_name','abbreviated_name','price','price_insurance')->get();
        return $main_analysis;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Abbreviation',
            'Price',
            'Insurance Price'
        ];
    }

}



