<?php

use App\HR\Branch;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Auth::routes();
Route::get('/login/employee', 'Auth\LoginController@showEmployeeLoginForm');
Route::get('/login/hospital', 'Auth\LoginController@showHospitalLoginForm');
Route::get('/login/patient', 'Auth\LoginController@showPatientLoginForm');

Route::post('/login/employee', 'Auth\LoginController@employeeLogin');
Route::post('/login/hospital', 'Auth\LoginController@hospitalLogin');
Route::post('/login/patient', 'Auth\LoginController@patientLogin');

Route::get('language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    Date::setLocale($lang);
    return back();
})->name('change_language');

Route::get('/', function (){
    $sectors = \App\Sector::get();
    $packages = \App\Package::all();
    return view('web.home', compact('sectors','packages'));
});
Route::get('/php-version12', function (){
    return PHP_VERSION;
});



Route::get('/home', function (){
    $sectors = \App\Sector::get();
    $packages = \App\Package::all();
    return view('web.home', compact('sectors','packages'));
});

Route::get('/alter', function (){
    dd(Branch::get());
});
Route::get('/migrate-db', function (){
    Artisan::call("migrate", ["--path" => "/database/migrations/2024_06_01_081541_create_divisions_table.php"]);
    Artisan::call("migrate", ["--path" => "/database/migrations/2024_06_01_081545_alter_table_main_analyses_add_division_id_column_table.php"]);
});

Route::get('/toggle', fn() => toggleSysStatus());


Route::view('/home_visit', 'home.home_visit');
Route::redirect('/', '/dashboard');


