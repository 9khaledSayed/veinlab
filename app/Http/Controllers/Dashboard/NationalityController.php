<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_nationalities');
        if ($request->ajax()) {
            $nationality = Nationality::all();
            return response()->json($nationality);
        }
        return  view('dashboard.nationalities.index');

    }

    public function create()
    {
        $this->authorize('create_nationalities');
        return  view('dashboard.nationalities.create');
    }

    public function store(Request $request)
    {

        $this->authorize('create_nationalities');

        $existArNationality = Nationality::onlyTrashed()->where('nationality', $request->nationality);
        $existEnNationality = Nationality::onlyTrashed()->where('name_english', $request->name_english);
        if ($existArNationality->exists()){
            $id = $existArNationality->first()->id;
            return redirect()->back()->withErrors(['nationality' => __('There was a deleted nationality with the sam name ') .  "<a href='" . route('dashboard.nationalities.restore', $id) . "' class='restore-item' style='text-decoration:underline;'>" . __('click here to restore it') . "</a>"]) ;
        }

        if ($existEnNationality->exists()){
            $id = $existEnNationality->first()->id;
            return redirect()->back()->withErrors(['nationality' => __('There was a deleted nationality with the sam name ') .  "<a href='" . route('dashboard.nationalities.restore', $id) . "' class='restore-item' style='text-decoration:underline;'>" . __('click here to restore it') . "</a>"]) ;
        }


        Nationality::create($this->validateAttributes());
        return redirect(route('dashboard.nationalities.index'));
    }

    public function edit(Nationality $nationality)
    {
        $this->authorize('update_nationalities');
        return  view('dashboard.nationalities.edit',compact('nationality'));
    }

    public function update(Request $request, Nationality $nationality)
    {
        $this->authorize('update_nationalities');
        $nationality->update($this->validateAttributes());
        $nationality->nationality = request('nationality');
        $nationality->save();
        return redirect(route('dashboard.nationalities.index'));
    }


    public function destroy($id ,Request $request)
    {
        $this->authorize('delete_nationalities');
        if($request->ajax()){
            Nationality::find($id)->destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.nationalities.index'));
    }

    public function validateAttributes() {
        return request()->validate([
            'nationality' => ['required', 'string', 'max:25', 'unique:nationalities'],
            'name_english' => ['required', 'string', 'max:25', 'unique:nationalities'],
        ]);
    }

    public function restore($id)
    {
        $nationality = Nationality::withTrashed()->find($id)->restore();
        return redirect(route('dashboard.nationalities.edit', $id));
    }
}
