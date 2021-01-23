<?php

namespace App\Http\Controllers\Dashboard;

use App\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Excel;
class DoctorController extends Controller implements  FromCollection, WithHeadings
{

    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index( Request $request)
    {
        $this->authorize('view_doctors');
        if ($request->ajax()) {
            $doctors = Doctor::all();
            return response()->json($doctors);
        }
        return view('dashboard.doctors.index');
    }


    public function create()
    {
        $this->authorize('create_doctors');
        return view('dashboard.doctors.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create_doctors');
        Doctor::create($this->validateDoctor());
        return view('dashboard.doctors.index');
    }


    public function show(Doctor $doctor)
    {
        $this->authorize('show_doctors');
        return view('dashboard.doctors.show', compact('doctor'));
    }


    public function edit(Doctor $doctor)
    {
        $this->authorize('update_doctors');
        return view('dashboard.doctors.edit',compact('doctor'));
    }


    public function update(Request $request, Doctor $doctor)
    {
        $this->authorize('update_doctors');
        $doctor->update($this->validateDoctor());
        return view('dashboard.doctors.index');

    }


    public function destroy( Request $request , $id )
    {
        $this->authorize('delete_doctors');
        if($request->ajax()){
            Doctor::find($id)->destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.doctors.index'));
    }

    public function report(Request $request)
    {
        $this->authorize('view_reports');
        if(isset($request->date)){
            $date = Carbon::create($request->date);
            $doctors = Doctor::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $total_amount = array_sum($doctors->pluck('wallet')->toArray());
            return view('dashboard.doctors.report', compact(['doctors', 'total_amount', 'date']));
        }
        $doctors = Doctor::get();
        $total_amount = array_sum($doctors->pluck('wallet')->toArray());
        return view('dashboard.doctors.report', compact(['doctors', 'total_amount']));
    }

    public function validateDoctor()
    {
        return request()->validate([
            'name' => 'required | string',
            'phone' => 'required | string',
            'email' => 'required | email',
            'percentage' => 'required | integer',
        ]);
    }


    public function export()
    {
        return Excel::download(new DoctorController() , 'الدكاتره.xls');
    }

    public function collection()
    {

        $doctors = Doctor::select('name','phone','email','wallet','no_patients')->get();
        return $doctors;
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



