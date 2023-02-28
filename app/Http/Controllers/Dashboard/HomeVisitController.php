<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\HomeVisit;
use App\Http\Controllers\Controller;
use App\Notifications\HomeVisitNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Excel;
class HomeVisitController extends Controller implements  FromCollection, WithHeadings
{
    public function index(Request $request)
    {
        $this->authorize('view_home_visits');
        if ($request->ajax()) {
            $homeVisits = HomeVisit::get();
            return response()->json($homeVisits);
        }
        return  view('dashboard.home_visits.index');
    }


    public function create()
    {
        return  view('dashboard.home_visits.create');
    }


    public function store(Request $request)
    {
        $this->authorize('update_home_visits');
        $homeVisit = HomeVisit::create($this->validateHomeVisit());
        Employee::first()->notify(new HomeVisitNotification($homeVisit->id));
        pushNotification();
        return redirect(route('dashboard.home_visits.index'));
    }

    public function request(Request $request)
    {
        $request['dateTime'] = $request['date'] . ' ' . $request['time'] . ':00';
        $homeVisit = HomeVisit::create($this->validateHomeVisit());

        Employee::first()->notify(new HomeVisitNotification($homeVisit->id));
        pushNotification();

        return redirect()->back()->with('success', 'your message,here');
    }

    public function show(HomeVisit $homeVisit)
    {
        $this->authorize('show_home_visits');
        return view( 'dashboard.home_visits.show', compact('homeVisit') );
    }


    public function edit(HomeVisit $homeVisit)
    {
        $this->authorize('update_home_visits');
        return view('dashboard.home_visits.update',compact('homeVisit'));
    }

    public function update(Request $request, HomeVisit $homeVisit)
    {
//        dd($request->toArray());
        $this->authorize('update_home_visits');
        $homeVisit->update($this->validateHomeVisit());
        return redirect(route('dashboard.home_visits.index'));
    }

    public function reply($id)
    {
        HomeVisit::find($id)->update([
            'status' => 2
        ]);
        return redirect()->back();
    }


    public function destroy($id ,Request $request)
    {
        $this->authorize('delete_home_visits');
        if($request->ajax()){
            HomeVisit::find($id)->destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.home_visits.index'));
    }


    public function validateHomeVisit()
    {
        return request()->validate([
            'name' => 'required | string',
            'address' => 'required | string',
            'phone' => 'required | string',
            'email' => 'nullable | email',
            'dateTime' => 'required | date',
            'sex'      => 'required'
        ]);
    }


    public function export()
    {
        return Excel::download(new HomeVisitController() , 'الزيارات المنزليه.xls');
    }

    public function collection()
    {

        $patients = HomeVisit::select('name','address','email','phone','dateTime')->get();
        return $patients;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Address',
            'Email',
            'Phone',
            'Date',
        ];
    }

}



