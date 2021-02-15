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
        if ( $request->ajax())
        {
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
        if ( $request->ajax())
        {
            Branch::create(
                $this->validate($request, [
                    'name'    => 'required | string',
                    'address' => 'required | string',
                ])
            );
        }
    }


    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        $this->authorize('view_branches');
        return view('hr.branches.edit',compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('view_branches');
        if ($request->ajax())
        {
            Branch::find($id)->update(
                [ 'name'    => $request['name'],
                  'address' => $request['address'],
                ]);
        }
        return view('hr.branches.index');
    }

    public function destroy(Branch $branch)
    {
        //
    }
}
