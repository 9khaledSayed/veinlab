<?php

use Illuminate\Support\Facades\Route;
use Jenssegers\Date\Date;

Auth::routes();
Route::get('/login/employee', 'Auth\LoginController@showEmployeeLoginForm');
Route::get('/login/hospital', 'Auth\LoginController@showHospitalLoginForm');
Route::get('/login/patient', 'Auth\LoginController@showPatientLoginForm');
//Route::get('/register/employee', 'Auth\RegisterController@showEmployeeRegisterForm');
//Route::get('/register/hospital', 'Auth\RegisterController@showHospitalRegisterForm');
//Route::get('/register/patient', 'Auth\RegisterController@showPatientRegisterForm');

Route::post('/login/employee', 'Auth\LoginController@employeeLogin');
Route::post('/login/hospital', 'Auth\LoginController@hospitalLogin');
Route::post('/login/patient', 'Auth\LoginController@patientLogin');
//Route::post('/register/employee', 'Auth\RegisterController@createEmployee');
//Route::post('/register/hospital', 'Auth\RegisterController@createHospital');
//Route::post('/register/patient', 'Auth\RegisterController@createPatient');

Route::get('language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    Date::setLocale($lang);
    return back();
})->name('change_language');

Route::get('/', function (){
    $sectors = \App\Sector::get();
    return view('home', compact('sectors'));
});
Route::get('/home', function (){
    $sectors = \App\Sector::get();
    return view('home', compact('sectors'));
});

Route::view('/home_visit', 'home.home_visit');

//Route::get('/foo', function()
//{
//    $employee1 = \App\Employee::create([
//        'fname_arabic'      => 'Talal',
//        'lname_arabic'      => 'Moahmed',
//        'fname_english'      => 'Talal',
//        'lname_english'      => 'Mohammed',
//        'birthdate'      => '2020-08-01',
//        'joined_date'      => '2020-08-01',
//        'nationality_id'      => '0',
//        'branch_id'      => '1',
//        'id_num'      => '54566546544',
//        'emp_num'      => '2121',
//        'contract_type'      => '1',
//        'start_date'      => '2020-08-01',
//        'contract_period'      => '12',
//        'basic_salary'      => '3000',
//        'phone'      => '01021212121',
//        'is_master'      => true,
//        'shift_type'   =>1,
//        'email'     => 'Talal.mooh305@gmail.com',
//        'password'  => Hash::make(966554121213),
//    ]);
//    $Super_Admin = \App\Role::find(1);
//    $employee1->assignRole($Super_Admin);
//    \App\Employee::find(1)->update([
//        'password'  => Hash::make(966554121213),
//    ]);
//    \App\Employee::find(2)->update([
//        'password'  => Hash::make(966554121213),
//    ]);
//    \App\Employee::find(3)->update([
//        'password'  => Hash::make(966554121213),
//    ]);
//    \App\Employee::find(4)->update([
//        'password'  => Hash::make(966554121213),
//    ]);
//    \App\Employee::find(5)->update([
//        'password'  => Hash::make(966554121213),
//    ]);
//});

Route::get('/fix', function()
{
    File::link(
        storage_path('app/public'), public_path('storage')
    );
});