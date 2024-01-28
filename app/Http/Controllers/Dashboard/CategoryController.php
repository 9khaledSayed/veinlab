<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(isset($request->company_id))
                $company_id = $request->company_id;
            else
                $company_id = $request->toArray()['query']['company_id'];
            $categories = Category::where('company_id',$company_id)->with('Company')->get();
            return response()->json($categories);
        }
    }



    public function store(Request $request)
    {

        $company = Company::create($this->validateCompany());

        for ($i = 1 ; $i <= $request['number_classes']; $i++ )
        {
            $class = new CompanyClass();
            $class->name     = $request['class_name'.$i];
            $class->insurance_company_id    = $company->id;

            $class->save();
        }

        return  view('dashboard.companies.index');

    }


    public function edit(Category $category)
    {
        return  view('dashboard.companies.update',compact('category'));
    }


    public function update( Category $Category)
    {
        $Category->update($this -> validateCompany());

        $Category->name     = request('name');
        $Category->ploicy_name_no  = request('ploicy_name_no');

        $Category->save();

        return  view('dashboard.companies.index');
    }






}
