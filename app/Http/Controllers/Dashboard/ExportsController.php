<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports;
use App\Hospital;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Template;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_exports');
        if ($request->ajax()) {
            $exports = Exports::with('doctor','hospital', 'employee')->get();
            return response()->json($exports);
        }
        return  view('dashboard.exports.index');
    }

    public function create(Request $request)
    {
        $this->authorize('create_exports');
        if($request->has('hospital_id')){
            $type = 'hospital';
            $item = Hospital::find($request->hospital_id);
        }else if($request->has('doctor_id')){
            $type = 'doctor';
            $item = Doctor::find($request->doctor_id);
        }else{
            return view('dashboard.exports.others_create');
        }
        return view('dashboard.exports.create', compact(['item', 'type']));
    }

    public function store(Request $request)
    {
        $this->authorize('create_exports');
        $id = $request->id;
        $this->validate($request, [
           'amount' => 'required|numeric',
           'CheckNo' => 'nullable|string',
           'checkDate' => 'nullable|date',
           'thisAbout' => 'nullable|string',
           'bank' => 'nullable|string'
        ]);
        if($request->type == "hospital"){
            Exports::create([
                'hospital_id' => $id,
                'employee_id' => auth()->user()->id,
                'amount'      => $request->amount,
                'CheckNo' => $request->CheckNo,
                'checkDate' => $request->checkDate,
                'thisAbout' => $request->thisAbout,
                'bank' => $request->bank,
                'type'        => 1,
                'serial_no'   => Exports::lastSerialNo(),
            ]);
            $hospital = Hospital::find($id);
            $hospital->wallet -= $request->amount;
            $hospital->save();

        }else if($request->type == "doctor"){
            Exports::create([
                'doctor_id' => $id,
                'employee_id' => auth()->user()->id,
                'amount'     => $request->amount,
                'CheckNo' => $request->CheckNo,
                'checkDate' => $request->checkDate,
                'thisAbout' => $request->thisAbout,
                'bank' => $request->bank,
                'type'       => 2,
                'serial_no'   => Exports::lastSerialNo()
            ]);
            $doctor = Doctor::find($id);
            $doctor->wallet -= $request->amount;
            $doctor->save();

        }else if($request->type == "others"){
            $this->validate($request, [
                'reason' => 'required|string',
                'CheckNo' => 'nullable|string',
                'checkDate' => 'nullable|date',
                'thisAbout' => 'nullable|string',
                'bank' => 'nullable|string'
            ]);
            Exports::create([
                'amount'     => $request->amount,
                'CheckNo' => $request->CheckNo,
                'checkDate' => $request->checkDate,
                'thisAbout' => $request->thisAbout,
                'bank' => $request->bank,
                'employee_id' => auth()->user()->id,
                'reason'     => $request->reason,
                'type'       => 4,
                'serial_no'   => Exports::lastSerialNo()
            ]);
        }
        return redirect(route('dashboard.exports.index'));

    }

    public function show(Exports $export)
    {
        $this->authorize('show_exports');
        if(in_array($export->type, [3,4,5])){
            return view('dashboard.exports.show', compact('export'));
        }
        else{
            $receiver = $export->doctor ?? $export->hospital;
            $template = Template::where('type', 9)->first();
            $results = [
                'voucher' => [
                    'amount' => $export->amount,
                    'date' => $export->created_at->format('Y-m-d'),
                    'company_name' => $receiver->name,
                    'about' => $export->thisAbout ?? '',
                    'check' => $export->CheckNo ?? '',
                    'bank' => $export->bank ?? '-',
                    'isCash' => !isset($export->CheckNo)? '<input checked="checked" type="checkbox" />': '<input type="checkbox" />',
                    'isCheck' => isset($export->CheckNo)? '<input checked="checked" type="checkbox" />': '<input type="checkbox" />',
                    'checkDate' => $export->checkDate ?? '-',
                    'receiver' => $receiver->name,
                    'accountant' => $export->employee->fullname(),
                ]
            ];
            $content = $template->collect_replace($results, $template->body);
            return view('dashboard.templates.print', [
                'content' => $content,
                'template' => $template
            ]);
        }

    }
}
