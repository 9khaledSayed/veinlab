<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Hospital;
use App\Http\Controllers\Controller;
use App\Revenue;
use App\Template;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_revenue');
        if ($request->ajax()) {
            $revenue = Revenue::with('employee')->get();
            return response()->json($revenue);
        }
        return  view('dashboard.revenue.index');
    }


    public function create(Request $request)
    {
        $this->authorize('create_revenue');
        if(!isset($request->company_id)){
            return view('errors.404-error');
        }
        $company = Company::find($request->company_id);
        return view('dashboard.revenue.create',compact('company'));

    }
    public function createHospitalRevenue(Hospital $hospital)
    {
        $this->authorize('create_revenue');
        return view('dashboard.revenue.create_hospital_revenue',compact('hospital'));

    }
    public function storeHospitalRevenue(Request $request, Hospital $hospital)
    {
        $this->authorize('create_revenue');
        $revenue = new Revenue($this->validateAttributes($request, config('enums.revenueType.hospital')));
        $revenue->hospital_id =  $hospital->id;
        $hospital->dues -= $request->amount;
        $hospital->save();
        $revenue->save();
        return redirect(route('dashboard.revenue.index'));

    }

    public function store(Request $request)
    {
        $this->authorize('create_revenue');
        Revenue::create($this->validateAttributes($request, config('enums.revenueType.company')));
        $company = Company::find($request->id);
        $company->our_money -= $request->amount;
        $company->save();
        return redirect(route('dashboard.revenue.index'));
    }


    public function show(Revenue $revenue)
    {
        $this->authorize('show_revenue');
        if(isset($revenue->company_id) || isset($revenue->hospital_id)){
            $receiver = $revenue->employee->fullname();
            $template = Template::where('type', 10)->first();
            $results = [
                'voucher' => [
                    'amount' => $revenue->amount,
                    'date' => $revenue->created_at->format('Y-m-d'),
                    'company_name' => $revenue->company->name ?? $revenue->hospital->name,
                    'about' => $revenue->thisAbout ?? '',
                    'check' => $revenue->CheckNo ?? '',
                    'bank' => $revenue->bank ?? '-',
                    'isCash' => !isset($revenue->CheckNo)? '<input checked="checked" type="checkbox" />': '<input type="checkbox" />',
                    'isCheck' => isset($revenue->CheckNo)? '<input checked="checked" type="checkbox" />': '<input type="checkbox" />',
                    'checkDate' => $revenue->checkDate ?? '-',
                    'receiver' => $receiver,
                    'accountant' => $revenue->employee->fullname(),
                ]
            ];
            $content = $template->collect_replace($results, $template->body);

            return view('dashboard.templates.print', [
                'content' => $content,
                'template' => $template
            ]);
        }
        return view('dashboard.revenue.show', compact('revenue'));
    }

    public function validateAttributes(Request $request, $type)
    {
        $request['type'] = $type;
        return ($this->validate($request, [
            'type' => 'required|numeric',
            'amount' => 'required|numeric',
            'CheckNo' => 'nullable|string',
            'checkDate' => 'nullable|date',
            'thisAbout' => 'nullable|string',
            'bank' => 'nullable|string'
        ]));
    }

}
