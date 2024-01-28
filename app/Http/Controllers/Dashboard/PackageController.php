<?php

namespace App\Http\Controllers\Dashboard;

use App\MainAnalysis;
use App\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index()
    {
        $this->authorize('view_packages');
        $packages = Package::all();
        return  view('dashboard.packages.index',compact('packages',$packages));
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
        $package= Package::create([
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

    public function edit(Package $package)
    {
        $this->authorize('update_packages');
        return view('dashboard.packages.edit', compact('package'), [
            'main_analysis'  => MainAnalysis::get(['general_name', 'price', 'id']),
        ]);
    }

    public function update(Request $request, Package $package)
    {
        $this->authorize('update_packages');
        $this->validator($request);
        $package->update([
            'name' => $request->name,
            'main_analysis' => serialize($request->main_analysis_id),
            'price' => $request->price,
        ]);
        return redirect(route('dashboard.packages.index'));
    }


    public function destroy(Package $package)
    {
        $this->authorize('delete_packages');
        $package->delete();
        return redirect()->back();
    }

    public function validator(Request $request)
    {
        return $this->validate($request , [
            'name' => ['required', 'string', 'max:255'],
            'main_analysis_id' => ['required'],
            'price' => ['required'],
        ]);
    }
}
