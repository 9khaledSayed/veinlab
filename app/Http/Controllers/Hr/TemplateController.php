<?php

namespace App\Http\Controllers\Hr;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function index(Request $request)
    {
        $this->authorize('view_templates');
        if($request->ajax()){
            $templates = Template::where('system', 'hr')->get();
            return response()->json($templates);
        }
        return view('hr.templates.index');
    }


    public function create()
    {
        $this->authorize('view_templates');
        $types = [
          'Salary Letter',
          'End of Service Settlement',
          'Service Certificate',
          'Company Contract Draft (saudi)',
          'Alert',
          'letterhead Header',
          'Letterhead Footer',
        ];
        return view('hr.templates.create', compact('types'));
    }


    public function store(Request $request)
    {
        $this->authorize('view_templates');
        $template = new Template($this->validate($request,[
            'arabic_name' =>'required',
            'english_name' =>'required',
            'type' =>'required|unique:templates',
            'body' =>'nullable|',
        ]));
        $template->system = 'hr';
        $template->save();
        return redirect(route('dashboard.hr.templates.index'));
    }


    public function edit(Template $template)
    {
        $this->authorize('view_templates');
        $types = [
            'Salary Letter',
            'End of Service Settlement',
            'Service Certificate',
            'Company Contract Draft (saudi)',
            'Alert',
            'letterhead Header',
            'Letterhead Footer',
        ];
        return view('hr.templates.edit', compact(['template', 'types']));
    }


    public function update(Request $request, Template $template)
    {
        $this->authorize('view_templates');
        $template->update($this->validate($request,[
            'arabic_name' =>'required',
            'english_name' =>'required',
            'body' =>'nullable|'
        ]));
        return redirect(route('dashboard.hr.templates.index'));
    }


    public function destroy(Template $template)
    {
        //
    }
}
