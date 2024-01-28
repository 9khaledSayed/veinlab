<?php

namespace App\Http\Controllers\Dashboard;

use App\NormalRange;
use App\SubAnalysis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MainAnalysis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Excel;
class SubAnalysisController extends Controller implements  FromCollection, WithHeadings
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_sub_analysis');
        if ($request->ajax()) {
            $response = getModelData(new SubAnalysis(), $request, ['main_analysis' => ['general_name']]);
            return response()->json($response);
        }
        return view('dashboard.sub_analysis.index');
    }

    public function getSubAnalysis(Request $request)
    {
        $this->authorize('view_sub_analysis');
        if ($request->ajax()) {
            if(isset($request->main_analysis_id	))
                $main_analysis_id = $request->main_analysis_id;
            else
                $main_analysis_id = $request->toArray()['query']['main_analysis_id'];
            $sub_analysis = SubAnalysis::where('main_analysis_id',$main_analysis_id)->with('main_analysis')->get();
            return response()->json($sub_analysis);
        }
    }




    public function create(Request $request)
    {
        $this->authorize('create_sub_analysis');
        $MainAnalyzes = MainAnalysis::all();
        return view('dashboard.sub_analysis.create',compact('MainAnalyzes'));
    }

    public function store(Request $request)
    {
        $this->authorize('create_sub_analysis');
        SubAnalysis::create($this->validateSubAnalysis());
        return redirect(route('dashboard.sub_analysis.index'));
    }

    public function show($id)
    {
        $this->authorize('show_sub_analysis');
        $subAnalysis = SubAnalysis::withTrashed()->find($id);
        return view('dashboard.sub_analysis.show',compact('subAnalysis'));
    }

//    public function edit(SubAnalysis $subAnalysis)
//    {
//        dd($subAnalysis->toArray());
//        $this->authorize('update_sub_analysis');
//        $MainAnalyzes = MainAnalysis::all();
//        return view('dashboard.sub_analysis.update',compact('subAnalysis','MainAnalyzes'));
//    }
//
//    public function update(Request $request, SubAnalysis $subAnalysis)
//    {
//        $this->authorize('update_sub_analysis');
//        $subAnalysis->update($this -> validateSubAnalysis());
//        return redirect(route('dashboard.sub_analysis.index'));
//    }

    public function destroy($id ,Request $request)
    {
        $this->authorize('delete_sub_analysis');
        if($request->ajax()){
            SubAnalysis::find($id)->destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.stock.index'));
    }

    public function validateSubAnalysis()
    {
        return request()->validate([
            'name' => 'required | string',
            'unit' => 'required | string',
            'main_analysis_id' => 'required | integer',
        ]);
    }
    public function export()
    {
        return Excel::download(new SubAnalysisController() , 'التحاليل الرئيسيه.xls');
    }

    public function collection()
    {
        $subAnalysis = SubAnalysis::select('name','unit','created_at')->get();
        return $subAnalysis;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Unit',
            'Date'
        ];
    }

}
