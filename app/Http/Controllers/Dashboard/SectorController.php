<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;

class SectorController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $sectors = Sector::get();
            return response()->json($sectors);
        }
        return view('dashboard.sectors.index');
    }

    public function create()
    {
        return view('dashboard.sectors.create');
    }

    public function store(Request $request)
    {
        $sector = new Sector($this->validator($request));
        if(isset($request->logo)){
            $this->saveLoge($request, $sector);
        }
        $sector->save();
        return redirect(route('dashboard.sectors.index'));
    }


    public function edit(Sector $sector)
    {
        return view('dashboard.sectors.edit', compact('sector'));
    }

    public function update(Request $request, Sector $sector)
    {
        $sector->update($this->validator($request));
        if(isset($request->logo) && !$request->sector_avatar_remove){
            $this->saveLoge($request, $sector);
        }else{
            Storage::delete('public/sector_logo/' . $sector->logo);
            $sector->logo ='' ;
        }
        $sector->save();
        return redirect(route('dashboard.sectors.index'));
    }

    public function destroy(Sector $sector, Request $request)
    {
        if($request->ajax()){
            $sector->delete();
            return response()->json([
                'status' => 'true',
                'message' => 'Item Deleted Successfully'
            ]);
        }
    }

    public function validator(Request $request)
    {
        return $this->validate($request ,[
           'name' => 'required|string:255',
           'percentage' => 'required|numeric',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
    }

    public function saveLoge(Request $request, Sector $sector)
    {
        $fileName = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('public/sector_logo', $fileName);
        $sector->logo = $fileName ;
    }
}
