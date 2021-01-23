<?php

namespace App\Http\Controllers\Dashboard;

use App\Nationality;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Setting;
use Excel;

class PatientController extends Controller implements  FromCollection, WithHeadings
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_patients');
        if ($request->ajax()) {
            $patients = Patient::with(['hospital', 'doctor'])->get();
            return response()->json($patients);
        }
        return  view('dashboard.patients.index');
    }

    public function create()
    {
        $this->authorize('create_patients');
        return  view('dashboard.patients.create', [
            'nationalities'  => Nationality::all(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create_patients');
        $request['password'] = Hash::make($request->phone);
        $rules = Patient::$rules;
        $rules['phone'] = ($rules['phone'] . setting('max_phone_no'));
        $rules['id_no'] = ($rules['id_no'] . '|digits:' . setting('max_id_no'));
        Patient::create($this->validate($request, $rules));
        return  redirect(route('dashboard.patients.index'));
    }

    public function show(Patient $patient)
    {
        $this->authorize('show_patients');
        $nationalities  = Nationality::all();
        return view('dashboard.patients.show', compact(['patient', 'nationalities']));
    }

    public function edit(Patient $patient)
    {
        $this->authorize('update_patients');
        $nationalities  = Nationality::all();
        return  view('dashboard.patients.edit',compact(['patient', 'nationalities']));
    }

    public function update(Request $request, Patient $patient)
    {
        $this->authorize('update_patients');
        $request['password'] = Hash::make($request->phone);
        $rules = Patient::$rules;
        $rules['phone'] = ($rules['phone'] . setting('max_phone_no'));
        $rules['id_no'] = ($rules['id_no'] . ',id_no,' . $patient->id . '|digits:' . setting('max_id_no'));
        $rules['email'] = ($rules['email'] . ',email,' . $patient->id);
        $patient->update($this->validate($request, $rules));
        return redirect(route('dashboard.patients.index'));
    }

    public function destroy( Request $request , $id )
    {
        $this->authorize('delete_patients');
        if($request->ajax()){
            Patient::find($id)->destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.patients.index'));
    }


    public function checkNoVisits(Patient $patient ,Request $request)
    {
        $no_visits = setting('no_visits');
        $discount  = setting('loyalty_discount_value');
        $offerIsActive = ($no_visits > 0 && $discount > 0);
        $acc_type  = $request['account_type'];
        if ($acc_type == 1 ) {$acc_type = 3; /* contract */}else{$acc_type = 2; /*individual*/}
        if ($patient->visit_no >= $no_visits && ( setting('loyalty_discount_include') == $acc_type || setting('loyalty_discount_include') == 1 )&& $offerIsActive)
        {
            $response = ["status" => 1 , "no_visits" => $patient->visit_no , "discount" =>  $discount];
            return response()->json($response);
        }
    }

    public function export()
    {
        return Excel::download(new PatientController() , 'المرضي.xls');
    }


    public function collection()
    {
        $patients = Patient::select('name','email','phone','age','visit_no')->get();
        return $patients;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Age',
            'Number Of Visits',
        ];
    }
}



