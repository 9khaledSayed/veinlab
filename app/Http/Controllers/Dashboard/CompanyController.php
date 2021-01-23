<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Excel;

class   CompanyController extends Controller implements  FromCollection, WithHeadings
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_companies');
        if ($request->ajax()) {
            $companies = Company::get();
            return response()->json($companies);
        }
        return  view('dashboard.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create_companies');
        return  view('dashboard.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create_companies');
        $company = Company::create($this->validateCompany());


        $numberOfClasses = (int)  $request['number_classes'];

        for ($i = $numberOfClasses; $i >= 1 ; $i-- )
        {

            if ( $request['class_name'.$i] != null  &&  $request['class_offer'.$i] != null)
            {
                $class = new Category();
                $class->name       = $request['class_name'.$i];
                $class->percentage = $request['class_offer'.$i];
                $class->company_id = $company->id;
                $class->save();
            }

        }

        return  view('dashboard.companies.index');
    }

    public function show(Company $company)
    {
        $this->authorize('show_companies');
        return view('dashboard.companies.show',compact('company'));
    }


    public function edit(Company $company)
    {
        $this->authorize('update_companies');
        $count  = 0;
        return  view('dashboard.companies.update',compact('company','count'));
    }


    public function update(Request $request, Company $company)
    {
        $this->authorize('update_companies');
        $company->categories()->delete();

        $numberOfClasses = (int)  $request['number_classes'];


        for ($i = $numberOfClasses; $i >= 1 ; $i-- )
        {
            if ( $request['class_name'.$i] != null   &&  $request['class_offer'.$i] != null )
            {
                $class = new Category();
                $class->name       = $request['class_name'.$i];
                $class->percentage = $request['class_offer'.$i];
                $class->company_id = $company->id;
                $class->save();
            }

        }
        $company->update($this->validateCompany());
        return  view('dashboard.companies.index');
    }

    public function destroy($id ,Request $request)
    {
        $this->authorize('delete_companies');
        if($request->ajax()){

            Company::find($id)->destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);

        }

        return redirect(route('dashboard.companies.index'));

    }

    public function report(Request $request)
    {
        $this->authorize('view_reports');
        if(isset($request->date)) {
            $date = Carbon::create($request->date);
            $companies = Company::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->get();
            $total_amount = array_sum($companies->pluck('our_money')->toArray());
            return view('dashboard.companies.report', compact(['companies', 'total_amount', 'date']));
        }
        $companies = Company::get();
        $total_amount = array_sum($companies->pluck('our_money')->toArray());
        return view('dashboard.companies.report', compact(['companies', 'total_amount']));
    }

    public function validateCompany()
    {
        return request()->validate([
            'name' => 'required | string',
        ]);
    }
    public function export()
    {
        return Excel::download(new CompanyController() , 'الشركات.xls');
    }

    public function collection()
    {

        $companies = Company::select('name','our_money','created_at')->get();
        return $companies;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Our Money',
            'Date'
        ];
    }
}


