<?php

namespace App\Http\Controllers\Dashboard;

use App\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfitController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $profits = Profit::all();
            return response()->json($profits);
        }
        return  view('dashboard.profits.index');
    }

}
