<?php

namespace App\Http\Controllers\Dashboard;

use App\Hospital;
use App\MainAnalysis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Excel;
class HospitalController extends Controller implements  FromCollection, WithHeadings
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_hospitals');
        if ($request->ajax()) {
            $hospitals = Hospital::all();
            return response()->json($hospitals);
        }
        return  view('dashboard.hospitals.index');
    }

    public function create()
    {
        $this->authorize('create_hospitals');
        $mainAnalyses = MainAnalysis::get();
        return view('dashboard.hospitals.create', compact('mainAnalyses'));
    }

    public function store(Request $request)
    {
        $this->authorize('create_hospitals');
        $mainAnalyses = [];
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|sometimes|unique:employees',
            'phone' => ['required'],
            'password' => ['required' ,'min:8', 'confirmed'],
            'main_analyses.*.id' => 'required|distinct',
            'main_analyses.*.price' => 'required|numeric|min:0',
        ]);


        if (array_key_exists('main_analyses', $data)){
            $mainAnalyses = $data['main_analyses'];
            unset($data['main_analyses']);
        }

        $hospital = Hospital::create($data);

        foreach ($mainAnalyses as $mainAnalysis) {
            $hospital->main_analyses()->attach([$mainAnalysis['id'] => ['price' => $mainAnalysis['price']]]);
        }


        return redirect(route('dashboard.hospitals.index'));

    }


    public function show(Hospital $hospital)
    {
        $this->authorize('show_hospitals');
        return view('dashboard.hospitals.show', compact('hospital'));
    }


    public function edit(Hospital $hospital)
    {
        $this->authorize('update_hospitals');
        $mainAnalyses = MainAnalysis::get();
        $hospitalMainAnalyses = $hospital->main_analyses->map(function ($main){
            return [
                'id' => $main->id,
                'price' => $main->pivot->price,
            ];
        });
        return view('dashboard.hospitals.edit', compact('hospital', 'mainAnalyses', 'hospitalMainAnalyses'));
    }


    public function update(Request $request, Hospital $hospital)
    {
        $this->authorize('update_hospitals');

        $mainAnalyses = [];
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|sometimes|unique:employees' . ',email,' . $hospital->id,
            'phone' => ['required'],
            'password' => ['nullable' ,'min:8', 'confirmed'],
            'main_analyses.*.id' => 'required|distinct',
            'main_analyses.*.price' => 'required|numeric|min:0',
        ]);


        if (array_key_exists('main_analyses', $data)){
            $mainAnalyses = $data['main_analyses'];
            unset($data['main_analyses']);
        }


        if(!isset($request->password)){
            unset($data['password']);
        }
        $hospital->update($data);
        $hospital->main_analyses()->detach();
        foreach ($mainAnalyses as $mainAnalysis) {
            $hospital->main_analyses()->attach([$mainAnalysis['id'] => ['price' => $mainAnalysis['price']]]);
        }

        return redirect(route('dashboard.hospitals.index'));
    }

    public function destroy($id ,Request $request)
    {
        $this->authorize('delete_hospitals');
        if($request->ajax()){
            Hospital::find($id)->destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.hospitals.index'));
    }
    public function report(Request $request)
    {

        $this->authorize('view_reports');
        if(isset($request->date)){
            $date = Carbon::create($request->date);
            $hospitals = Hospital::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $total_amount = array_sum($hospitals->pluck('wallet')->toArray());
            return view('dashboard.hospitals.report', compact(['hospitals', 'total_amount', 'date']));
        }
        $hospitals = Hospital::get();
        $total_amount = array_sum($hospitals->pluck('wallet')->toArray());
        return view('dashboard.hospitals.report', compact(['hospitals', 'total_amount']));
    }

    public function export()
    {
        return Excel::download(new HospitalController() , 'المستشفيات.xls');
    }

    public function collection()
    {

        $patients = Hospital::select('name','phone','email','no_patients')->get();
        return $patients;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'wallet',
            'Number Of Patients',
        ];
    }

}


