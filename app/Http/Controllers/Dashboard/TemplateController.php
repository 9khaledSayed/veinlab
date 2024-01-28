<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $templates = Template::where('system', 'lab')->get();
            return response($templates);
        }
        return view('dashboard.templates.index');
    }

    public function create()
    {
        $types = [
            7 =>'Invoice',
            8 => 'Analysis result',
            9 => 'Payment Voucher',
            10 => 'Recipient Voucher',
            11 => 'Stock Model',
        ];
        return view('dashboard.templates.create', compact('types'));
    }

    public function store(Request $request)
    {
        $template = new Template($this->validate($request,[
            'arabic_name' =>'required',
            'english_name' =>'required',
            'type' =>'required|unique:templates',
            'body' =>'nullable|',
        ]));
        $template->system = 'lab';
        $template->save();
        return redirect(route('dashboard.templates.index'));
    }

    public function edit(Template $template)
    {
        $types = [
            7 =>'Invoice',
            8 => 'Analysis result',
        ];
        return view('dashboard.templates.edit', compact(['template', 'types']));
    }

    public function update(Request $request, Template $template)
    {

        $template->update($this->validate($request,[
            'arabic_name' =>'required',
            'english_name' =>'required',
            'body' =>'nullable|',
        ]));
        $template->header = (isset($request->header) == true)?1:0;
        $template->footer = (isset($request->footer) == true)?1:0;
        $template->save();
        return redirect(route('dashboard.templates.index'));
    }

}
