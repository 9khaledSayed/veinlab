<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function show($barcode)
    {
        return view('dashboard.barcodes.show', compact('barcode'));
    }
}
