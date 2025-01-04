<?php

namespace App\Http\Controllers\Dashboard;

use App\Division;
use App\MainAnalysis;
use App\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $response = getModelData(new Division(), $request);
            return response()->json($response);
        }

        return view('dashboard.divisions.index');
    }


    public function create()
    {
        $this->authorize('create_packages');
        return  view('dashboard.packages.create', [
            'main_analysis'  => MainAnalysis::get(['general_name', 'price', 'id']),
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create_packages');
        $this->validator($request);
        $package = Package::create([
            'name' => $request->name,
            'main_analysis' => serialize($request->main_analysis_id),
            'price' => $request['price'],
        ]);

        return redirect(route('dashboard.packages.index'));
    }


    public function show(Package $package)
    {
        //
    }

    public function edit(Division $division)
    {
        $division->load('mainAnalyses');
        return view('dashboard.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'analyses_ids' => ['required', 'array', 'min:1'],
        ]);
        $division->update([
            'name' => $request->name,
        ]);

        MainAnalysis::whereIn('id', $request->analyses_ids)
        ->update(['division_id' => $division->id]);
        return redirect(route('dashboard.divisions.index'));
    }


    public function destroy(Package $package)
    {
        $this->authorize('delete_packages');
        $package->delete();
        return redirect()->back();
    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'main_analysis_id' => ['required'],
            'price' => ['required'],
        ]);
    }
}
