<?php

use App\Doctor;
use App\Sector;
use App\Company;
use App\Invoice;
use App\Package;
use App\Patient;
use App\Employee;
use App\Hospital;
use App\PromoCode;
use App\MainAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/export_employees", fn() => Employee::get());
Route::get("/export_patients", fn() => Patient::get());
Route::get("/export_promo", fn() => PromoCode::get());
Route::get("/export_basic_data", fn() => [
    "hospitals" => Hospital::get(),
    "sectors" => Sector::get(),
]);
Route::get("/export_count", fn() => Invoice::with(["patient", "hospital", "doctor", "company", "company.categories", 'waiting_labs', 'waiting_labs.main_analysis','waiting_labs.results'])->count());
Route::get("/export_invoices", fn() => Invoice::with(["patient", "hospital", "doctor", "company", "company.categories", 'waiting_labs', 'waiting_labs.main_analysis','waiting_labs.results'])->skip(6000)->take(1000)->get()->map(function($invoice){
    return [
        "id_no" => $invoice->patient->id_no,
        "branch_id" => $invoice->branch_id,
        "hospital" => $invoice->hospital,
        "company" => $invoice->company,
        "category" => $invoice->company ? $invoice->company->categories()->find($invoice->category_id) : null,
        "doctor" => $invoice->doctor,
        "transfer" => $invoice->transfer,
        "main_analysis" => MainAnalysis::whereIn("id", unserialize($invoice->main_analysis) ?? [])->get()->pluck("general_name"),
        "packages" => Package::whereIn("id", unserialize($invoice->packages) ?? [])->get()->pluck("name"),
        "total_price" => $invoice->total_price,
        "total_cost" => $invoice->total_cost,
        "tax" => $invoice->tax,
        "discount" => $invoice->discount,
        "amount_paid" => $invoice->amount_paid,
        "pay_method" => $invoice->pay_method,
        "approved" => $invoice->approved,
        "approved_date" => $invoice->approved_date,
        "status" => $invoice->status,
        "waiting_labs" => $invoice->waiting_labs,
        "created_at" => $invoice->created_at,
        "updated_at" => $invoice->updated_at,
    ];
}));

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
