<?php

namespace App\Http\Controllers\Hr;

use App\HR\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_branches');
        if ($request->ajax()) {
            $branches = Branch::all();
            $data['data'] = $branches;
            return response()->json($data);
        }
        return view('hr.branches.index');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->authorize('view_branches');
        if ($request->ajax()) {
            $data = $this->validate($request, [
                'name' => 'required | string',
                'address' => 'required | string',
                'report_signature' => 'required|image|mimes:jpeg,png,jpg',
                'license_no' => 'required|string|max:50',
            ]);

            if (isset($request->report_signature)) {
                $fileName = $request->file('report_signature')->getClientOriginalName();
                $fileName = 'Nabd_' . time() . $fileName;
                $request->file('report_signature')->storeAs('public/branches', $fileName);
                $data['report_signature'] = 'storage/branches/' . $fileName;
            }

            Branch::create($data);
        }
    }


    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        // dd($branch);
        $this->authorize('view_branches');
        return view('hr.branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('view_branches');
        $data = $this->validate($request, [
            'name' => "required|string|unique:branches,name,$id",
            'address' => 'required | string',
            'report_signature' => 'nullable|image|mimes:jpeg,png,jpg',
            'license_no' => 'required|string|max:50',
        ]);
        if (isset($request->report_signature)) {
            $fileName = $request->file('report_signature')->getClientOriginalName();
            $fileName = 'Nabd_' . time() . $fileName;
            $request->file('report_signature')->storeAs('public/branches', $fileName);
            $data['report_signature'] = 'storage/branches/' . $fileName;
        }

        if ($request->ajax()) {
            Branch::find($id)->update($data);
        }
        return view('hr.branches.index');
    }

    public function destroy(Branch $branch)
    {
        //
    }
}
