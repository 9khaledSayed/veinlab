<?php

namespace App\Http\Controllers\Hr;

use App\HR\Branch;
use App\Employee;
use App\Memo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notification AS notificationTable;
use Illuminate\Support\Facades\Notification;
class MemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_all_memos');
        if ( $request->ajax())
        {
            $memos = Memo::with('branch')->get();
            return response()->json($memos);
        }
        $branches = Branch::all();
        return view('hr.memos.index',compact('branches'));
    }

    public function myMemos(Request $request)
    {
        $this->authorize('view_my_memos');
        if ( $request->ajax())
        {
            $branch_id = Auth::guard('employee')->user()->branch_id;
            $memos = Memo::where('branch_id',$branch_id)->with('branch')->get();
            return response()->json($memos);
        }

        $branches = Branch::all();

        return view('hr.memos.my_memos',compact('branches'));

    }

    public function create()
    {
        $this->authorize('create_memos');
        $branches = Branch::all();
        return view('hr.memos.create',compact('branches'));
    }

    public function store(Request $request)
    {
        $this->authorize('create_memos');
        $branch_id = $request['branch_id'];
        $employees  = Employee::where('branch_id',$branch_id)->get();
        $memo = Memo::create(
            $this->validate($request, [
                'branch_id'=> 'required | integer',
                'icon'     => 'required | string',
                'title_ar' => 'required | string|string|max:191',
                'title_en' => 'nullable | string|string|max:191',
                'text_ar'  => 'required | string|string|max:191',
                'text_en'  => 'nullable | string|string|max:191'
            ])
        );

        $message = $memo->text_ar;

        Notification::send($employees, new \App\Notifications\MemoNotification($message));

    }

    public function show(Memo $memo,Request $request)
    {
        $this->authorize('create_memos');
        if ( $request->ajax())
        {

            $seenEmployees = notificationTable::where([
                ['type','=','App\Notifications\MemoNotification'],
                ['data','LIKE','%"memo":'.$memo->id.'%'],
                ['read_at','!=',null]
            ])->with('employee')->get();
            $data['data'] = $seenEmployees;

            return response()->json($data);
        }

        $branches = Branch::all();

        return view('hr.memos.seen',compact('branches'));
    }

    public function edit(Memo $memo)
    {
        //
    }

    public function update(Request $request, Memo $memo)
    {
        //
    }

    public function destroy(Memo $memo)
    {
        \App\Notification::where('type', 'App\Notifications\MemoNotification')->where('notifiable_id', $memo->id)->delete();
        $memo->delete();
    }
}
