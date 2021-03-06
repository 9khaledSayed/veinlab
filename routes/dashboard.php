<?php

use Illuminate\Support\Facades\Route;

Route::post('/home_visit', 'Dashboard\HomeVisitController@request');
Route::get("Notifications/WaitingLab","NotificationsController@waitingLab")->middleware('auth:employee,patient,hospital');
Route::put("Notifications/WaitingLab/{id}","NotificationsController@markAsRead")->middleware('auth:employee,patient,hospital');
Route::get('/promo_codes/{code}','Dashboard\PromoCodeController@showPromocode')->middleware('auth:patient');
Route::put("/dashboard/disapprove/{id}","Dashboard\WaitingLabController@disApprove");

Route::prefix('dashboard')->name('dashboard.')->namespace('Dashboard')->middleware('auth:employee,patient,hospital')->group(function(){


    Route::get('/', 'Dashboard@index')->name('index');
    Route::get("checkNoVisits/{patient}","PatientController@checkNoVisits");
    Route::get('abilities', 'AbilityController@index');
    Route::get('barcodes/{barcode}', 'BarcodeController@show');
    Route::get('waiting_labs/accounts', 'WaitingLabController@accounts');
    Route::get('invoices_done', 'InvoiceController@getInvoicesDone');
    Route::get('main_analysis/report', 'MainAnalysisController@report')->name('main_analysis.report');
    Route::get('hospitals/report', 'HospitalController@report')->name('hospitals.report');
    Route::get('doctors/report', 'DoctorController@report')->name('doctors.report');
    Route::get('companies/report', 'CompanyController@report')->name('companies.report');
    Route::get('home_visits/{id}/reply', 'HomeVisitController@reply');
    Route::get('reports', 'ReportController@index')->name('reports.index');
    Route::get('reports/print', 'ReportController@print')->name('reports.print');
    Route::get('invoices/{id}/delete', 'InvoiceController@discard');
    Route::any('settings/critical', 'SettingsController@critical')->name('settings.critical');
    Route::any('settings/language', 'SettingsController@language')->name('settings.language');
    Route::any('settings/offers', 'SettingsController@offers')->name('settings.offers');
    Route::any('settings/tax', 'SettingsController@tax')->name('settings.tax');
    Route::get('waiting_labs/archives', 'WaitingLabController@archives')->name('waiting_labs.archives');
    Route::match(['get', 'post'],"roles/create_assignment","RoleController@create_assignment")->name('roles.create_assignment');
    Route::match(['get', 'post'],"roles/edit_assignment/{id}","RoleController@edit_assignment")->name('roles.edit_assignment');
    Route::get("roles/assigned_employees","RoleController@assigned_employees")->name('roles.assigned_employees');
    Route::get("roles/assigned_employees/{id}","RoleController@assigned_roles");
    Route::get('invoices/print/{id}', 'InvoiceController@print')->name('invoices.print');
    Route::post("approve_result","SmsController@approve");
    Route::post("sendWsms","SmsController@sendSms_Noti");
    Route::get('results/print/{id}', 'ResultController@print')->name('results.print');
    Route::get('profits', 'ProfitController@index')->name('profits.index');
    Route::get('statistics', 'StatisticsController@index')->name('statistics.index');
    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings', 'SettingsController@store')->name('settings.store');
    Route::get('results/{waiting_lab}/edit', 'ResultController@edit')->name('results.edit');
    Route::get('transferPrice/{transfer}', 'WaitingLabController@transferPrice');
    Route::resource("templates","TemplateController")->except(['show', 'destroy']);
    Route::resource("sectors","SectorController")->except('show');
    Route::resource("promo_codes","PromoCodeController")->except('show');
    Route::resource("packages","PackageController")->except('show');
    Route::resource("nationalities","NationalityController")->except('show');
    Route::resource("results","ResultController")->except(['destroy', 'edit']);
    Route::resource("waiting_labs","WaitingLabController")->except(['update', 'destroy']);
    Route::resource("categories","CategoryController")->except(['create','show' , 'destroy']);
    Route::resource("invoices","InvoiceController")->except(['create','store' , 'edit', 'update']);
    Route::resource("normal_ranges","NormalRangeController")->except(['show','edit' , 'update', 'destroy']);
    Route::resource("exports","ExportsController")->except(['edit' , 'update', 'destroy']);
    Route::resource("revenue","RevenueController")->except(['edit' , 'update', 'destroy']);
    Route::resource("stock","StockController")->except(['edit', 'destroy']);
    Route::resource("sub_analysis","SubAnalysisController")->except(['edit', 'update']);
    Route::get('myProfile/account_info', 'ProfileController@accountInfo')->name('myProfile.account_info');
    Route::post('myProfile/update_account_info', 'ProfileController@updateAccountInfo')->name('myProfile.update_account_info');
    Route::get('myProfile/change_password', 'ProfileController@changePasswordForm')->name('myProfile.change_password');
    Route::post('myProfile/change_password', 'ProfileController@changePassword')->name('myProfile.changePassword');
    Route::get('hospital_revenue/{hospital}/create', 'RevenueController@createHospitalRevenue')->name('revenue.createHospitalRevenue');
    Route::post('hospital_revenue/{hospital}/store', 'RevenueController@storeHospitalRevenue')->name('revenue.storeHospitalRevenue');
    Route::resources([
        'main_analysis'  => 'MainAnalysisController',
        'patients'       => 'PatientController',
        'hospitals'      => 'HospitalController',
        'doctors'        => 'DoctorController',
        'companies'      => 'CompanyController',
        'home_visits'    => 'HomeVisitController',
        'roles'          => 'RoleController',
    ]);

});

Route::get('sub_analysis/getSubAnalysis','Dashboard\SubAnalysisController@getSubAnalysis');
Route::get('stocks/getSales','Dashboard\StockController@getSales');
Route::get('stocks/getItems','Dashboard\StockController@getItems');

Route::post('/email','HomeController@mailMe');
Route::prefix('export')->name('export.')->namespace('Dashboard')->middleware('auth:employee,patient,hospital')->group(function(){
//    Route::get('employees', 'EmployeeController@export')->name('employees.export');
    Route::get('patients', 'PatientController@export')->name('patients.patients');
    Route::get('home_visits', 'HomeVisitController@export')->name('home_visits.export');
    Route::get('doctors', 'DoctorController@export')->name('doctors.export');
    Route::get('hospitals', 'HospitalController@export')->name('hospitals.export');
    Route::get('companies', 'CompanyController@export')->name('companies.export');
    Route::get('main_analysis', 'MainAnalysisController@export')->name('main_analysis.export');
    Route::get('sub_analysis', 'SubAnalysisController@export')->name('sub_analysis.export');
    Route::get('results', 'ResultController@export')->name('results.export');
    Route::get('stock', 'StockController@export')->name('stock.export');
    Route::get('countries', 'NationalityController@export')->name('countries.export');
    Route::get('invoices', 'InvoiceController@export')->name('invoices.export');
    Route::get('exports', 'ExportsController@export')->name('exports.export');
    Route::get('imports', 'RevenueController@export')->name('imports.export');
    Route::get('profits', 'ProfitController@export')->name('profits.export');
});

Route::get('/admin', function (){
   \Illuminate\Support\Facades\Artisan::call('db:seed');
});
