<?php

namespace App\Http\Controllers\Dashboard;

use App\Hospital;
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
        return view('dashboard.hospitals.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create_hospitals');
        $rules = Hospital::$rules;
        Hospital::create($this->validate($request, $rules));
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
        return view('dashboard.hospitals.edit', compact('hospital'));
    }


    public function update(Request $request, Hospital $hospital)
    {
        $this->authorize('update_hospitals');
        $rules = Hospital::$rules;
        $rules['email'] = ($rules['email'] . ',email,' . $hospital->id);
        if(!isset($request->password)){
            unset($rules['password']);
        }
        $hospital->update($this->validate($request, $rules));
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


