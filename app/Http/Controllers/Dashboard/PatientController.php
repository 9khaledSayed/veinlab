<?php

namespace App\Http\Controllers\Dashboard;

use App\Nationality;
use App\Patient;
use App\Rules\UniquePhoneNumber;
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
            $response = getModelData(new Patient(), $request);
//            $response = Patient::get();
            return response()->json($response);
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
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8'],
            "name" => ['required', 'string', 'max:255'],
            "name_in_english" => ['nullable', 'string', 'max:255'],
            "email" => 'nullable|string|email:dns|max:255|unique:patients',
            'phone'  => ['required', 'numeric', 'regex:/^(05)[0-9]{8}$/', new UniquePhoneNumber('Patient')],
            "id_no" => 'required|sometimes|unique:patients',
            "gender" => ['required'],
            "age" => ['required'],
            "city" => ['nullable', 'string', 'max:255'],
            "address" => ['nullable', 'string', 'max:255'],
            "diseases" => ['nullable', 'string', 'max:255'],
            "blood_type" => ['nullable', 'string', 'max:255'],
            "weight" => ['nullable', 'string', 'max:255'],
            "height" => ['nullable', 'string', 'max:255'],
            "nationality_id" => ['required', 'numeric']
        ]);

        Patient::create($data);
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

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8'],
            "name" => ['required', 'string', 'max:255'],
            "name_in_english" => ['nullable', 'string', 'max:255'],
            "email" => 'nullable|string|email:dns|max:255|unique:patients' . ',email,' . $patient->id,
            'phone'  => ['required', 'numeric', 'regex:/^(05)[0-9]{8}$/', new UniquePhoneNumber('Patient', $patient->id)],
            "id_no" => 'required|sometimes|unique:patients' . ',id_no,' . $patient->id,
            "gender" => ['required'],
            "age" => ['required'],
            "city" => ['nullable', 'string', 'max:255'],
            "address" => ['nullable', 'string', 'max:255'],
            "diseases" => ['nullable', 'string', 'max:255'],
            "blood_type" => ['nullable', 'string', 'max:255'],
            "weight" => ['nullable', 'string', 'max:255'],
            "height" => ['nullable', 'string', 'max:255'],
            "nationality_id" => ['required', 'numeric']
        ]);

        $patient->update($data);
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
        $patients = Patient::get()->map(function ($patient){
            return [
                'name' => $patient->name,
                'email' => $patient->email,
                'phone' => $patient->full_phone,
                'age' => $patient->age,
                'visit_no' => $patient->visit_no,
            ];
        });
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



