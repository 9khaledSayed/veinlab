<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports;
use App\Stock;
use App\Http\Controllers\Controller;
use App\Template;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index(Request $request)
    {
        $this->authorize('view_stocks');
        if ($request->ajax()) {
            $stock = Stock::all();
            return response()->json($stock);
        }
        return  view('dashboard.stock.index');
    }


    public function create()
    {
        $this->authorize('create_stocks');
        $companies = Stock::distinct('company_name')->pluck('company_name');
        return  view('dashboard.stock.create',compact('companies'));
    }

    public function store(Request $request)
    {
        $this->authorize('create_stocks');
        if($request['company_name_exist'] != "0") {
            $request['company_name'] = $request['company_name_exist'];
        }
        request()->validate([
            'company_name' => 'required',
        ]);
        //$this->validateStock();
        $total = 0;
        $no_sales = intval($request['number_sales']);
        $purchases = array();
        $stock = new Stock();
        $stock->company_name = $request['company_name'];

        for ($i = $no_sales; $i >= 1 ; $i-- )
        {
            if ( $request['item'.$i] != null && $request['quantity'.$i] != null && $request['price'.$i] != null )
            {
                $purchases[$request['item'.$i]] = [
                    'item'     =>  $request['item'.$i],
                    'quantity' =>  $request['quantity'.$i],
                    'price'    =>  $request['price'.$i]
                ];
                $total += $request['price'.$i];
            }

        }

        $stock->purchases = serialize($purchases);
        $stock->save();
        Exports::create([
            'amount'     => $total,
            'employee_id' => auth()->user()->id,
            'type'       => 3,
            'serial_no'   => isset($last_serial) ? ++$last_serial : date("Y") . '11111' . '10000',
            'stock_id' => $stock->id
        ]);
        return redirect(route('dashboard.stock.index'));
    }

    public function show(Stock $stock)
    {
        $this->authorize('show_stocks');
        $purchases = unserialize($stock->purchases);
        $purchases = array_values($purchases);
        $index = 0;
        $total = 0;
        $template = Template::where('type', 11)->first();
        $purchases_results = $template->stock_purchases($purchases);
        $results = [
            'stock' => [
                'total' => $purchases_results['total'] . ' ' . __('SAR'),
                'invoice_no' => $stock->id,
                'date' => $stock->created_at->format('Y-m-d'),
                'company_name' => $stock->company_name,
                'logo_url' => asset('logo/logo1.png'),
                'purchases_table' => $purchases_results['content'],
            ]
        ];
        $content = $template->collect_replace($results, $template->body);
        return view('dashboard.templates.print', [
            'content' => $content,
            'template' => $template
        ]);
    }


    public function edit(Stock $stock)
    {
        $this->authorize('update_stocks');
        return  view('dashboard.stock.edit',compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $this->authorize('update_stocks');
        $stock->update($this->validateStock());
        return redirect(route('dashboard.stock.index'));
    }


    public function destroy($id ,Request $request)
    {
        $this->authorize('delete_stocks');
        if($request->ajax()){
            Stock::find($id)->destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.stock.index'));
    }

    public function validateStock()
    {

        return request()->validate([
            'company_name' => ' required | string | nullable',
            'item' => 'required | string',
            'quantity' => 'required | integer | max:1000000',
            'price' => 'required | numeric | max:1000000',
        ]);
    }

    public function getItems(Request $request)
    {
        if ($request->ajax()) {
            if(isset($request->main_analysis_id	))
                $stock_id = $request->stock_id;
            else
                $stock_id = $request->toArray()['query']['stock_id'];
            $stock = Stock::find($stock_id);
            $purchases = unserialize($stock->purchases);
            $purchases = array_values($purchases);
            dd($purchases);
            return response()->json($purchases);
    }
    }
}
