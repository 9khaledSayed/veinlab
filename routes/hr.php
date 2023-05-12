<?php

use Illuminate\Support\Facades\Route;


Route::prefix('dashboard/hr')->name('dashboard.hr.')->namespace('Hr')->middleware('auth:employee')->group(function(){
    Route::view('/', 'hr.index')->name('index');
    Route::get('attendance/check/{id}', 'AttendanceController@attendanceCheck');
    Route::get('employee/salary/{id}', 'EmployeeController@getSalary');
    Route::get('deductions/cancel/{id}', 'DeductionController@cancel');
    Route::get('deductions/update/{id}', 'DeductionController@update');
    Route::get('additions/cancel/{id}', 'AdditionController@cancel');
    Route::get('additions/update/{id}', 'AdditionController@update');
    Route::get('employees/operations/{id}', 'EmployeeController@operations')->name('employees.operations');
    Route::get('salary_reports/{salary_report}/reissue', 'SalaryReportController@reissue')->name('salary_reports.reissue');
    Route::get('salary_reports/{salary_report}/cancel', 'SalaryReportController@cancel')->name('salary_reports.cancel');
    Route::get('salary_reports/{salary_report}/reject', 'SalaryReportController@reject')->name('salary_reports.reject');
    Route::get('salary_reports/{salary_report}/approve', 'SalaryReportController@approve')->name('salary_reports.approve');
    Route::get('attendance/my_attendance', 'AttendanceController@myAttendance')->name('attendance.my_attendance');
    Route::get('salary_reports/pending', 'SalaryReportController@pending')->name('salary_reports.pending');
    Route::get('salary_reports/{month}/check_status', 'SalaryReportController@check_status')->name('salary_reports.check_status');
    Route::get('salary_induction/create', 'RequestsController@createSalaryReq')->name('salary_induction.create');
    Route::get('vacation/create', 'RequestsController@createVacationReq')->name('vacation.create');
    Route::get('decisions/terminated_employees', 'DecisionController@terminated_employees')->name('decisions.terminated_employees');
    Route::get('decisions/terminate_employee', 'DecisionController@terminate_employee')->name('decisions.terminate_employee');
    Route::get('decisions/terminated_cancel/{id}', 'DecisionController@terminated_cancel')->name('decisions.terminated_cancel');
    Route::get('decisions/terminated_employee/{id}', 'DecisionController@show_terminated_employee')->name('decisions.show_terminated_employee');
    Route::get('decisions/my_decisions', 'DecisionController@my_decisions')->name('decisions.my_decisions');
    Route::get('decisions/all_decisions', 'DecisionController@all_decisions')->name('decisions.all_decisions');
    Route::get('decisions/suspended_employees', 'DecisionController@suspended_employees')->name('decisions.suspended_employees');
    Route::any('decisions/suspend_employee', 'DecisionController@suspend_employee')->name('decisions.suspend_employee');
    Route::any('decisions/suspend_employee/approve/{id}', 'DecisionController@suspend_approve')->name('decisions.suspend_approve');
    Route::any('decisions/suspend_employee/cancel/{id}', 'DecisionController@suspend_cancel')->name('decisions.suspend_cancel');
    Route::get('decisions/suspend_employee/{id}', 'DecisionController@show_suspend_employee')->name('decisions.show_suspend_employee');
    Route::get('decisions/service_settlement/{id}', 'DecisionController@service_settlement')->name('decisions.service_settlement');
    Route::get('decisions/service_certificate/{id}', 'DecisionController@service_certificate')->name('decisions.service_certificate');
    Route::post('decisions/end_service_reward', 'DecisionController@end_service_reward')->name('decisions.end_service_reward');
    Route::get('permission/create', 'RequestsController@createPermissionReq')->name('permission.create');
    Route::get('trip/create', 'RequestsController@createTripReq')->name('trip.create');
    Route::get('debt/create', 'RequestsController@createDebtReq')->name('debt.create');
    Route::get('complaint/create', 'RequestsController@createComplaintReq')->name('complaint.create');
    Route::get('requests/mine', 'RequestsController@myRequests')->name('requests.mine');
    Route::get('requests/pending', 'RequestsController@pendingRequests')->name('requests.pending');
    Route::get('requests/finished', 'RequestsController@finishedRequests');
    Route::get('vacations/mine', 'VacactionController@myVacations');
    Route::get('vacations', 'VacactionController@Vacations');
    Route::get('vacations/create', 'VacactionController@create');
    Route::get('vacations/balances', 'LeaveBalanceController@index');
    Route::get('vacations/getLeaveBalance', 'LeaveBalanceController@getLeaveBalance');
    Route::get('memos/mine', 'MemoController@myMemos')->name('memos.mine');


    Route::post('vacations', 'VacactionController@store');
    Route::post('salary_induction/store', 'RequestsController@storeSalaryReq')->name('salary_induction.store');
    Route::post('vacation/store', 'RequestsController@storeVacationReq')->name('vacation.store');
    Route::post('permission/store', 'RequestsController@storePermissionReq')->name('permission.store');
    Route::post('trip/store', 'RequestsController@storeTripReq')->name('trip.store');
    Route::post('debt/store', 'RequestsController@storeDebtReq')->name('debt.store');
    Route::post('complaint/store', 'RequestsController@storeComplaintReq')->name('complaint.store');
    Route::put('request/{request}', 'RequestsController@update');
    Route::delete('vacations/{id}', 'VacactionController@delete');
    Route::delete('request/{id}', 'RequestsController@delete');

    Route::resource('employees', 'EmployeeController');
    Route::resource('roles', 'RoleController');
    Route::resource('salary_reports', 'SalaryReportController')->except(['edit','update', 'destroy']);
    Route::resource('salaries', 'SalaryController')->except(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('attendance', 'AttendanceController')->except(['show', 'edit', 'update', 'destroy']);
    Route::resource('templates', 'TemplateController')->except(['show', 'destroy']);
    Route::resource('deductions', 'DeductionController')->except(['update','show','edit','create']);
    Route::resource('additions', 'AdditionController')->except(['update','show','edit','create']);
    Route::resource('loans', 'LoanController')->except(['update','show','edit','create']);
    Route::resource('my_requests', 'RequestsController')->except(['index','create','show','edit','destroy']);
    Route::resource('vacation_types', 'VacationTypeController')->except(['show','destroy']);
    Route::resource('memos', 'MemoController')->except(['edit', 'update']);
    Route::resource('branches', 'BranchController')->except(['create', 'show', 'destroy']);
    Route::resource('adds_deds_types', 'AdditionDeductionTypesController')->except(['create', 'destroy']);
//    Route::resource('salary_types', 'SalaryTypeController');
    Route::resource('allowance_types', 'AllowanceTypeController')->except(['create', 'destroy']);
    Route::resource('holidays', 'HolidayController')->except('show');
    Route::put('notifications/{id}','NotificationsController@markAsRead');
    Route::get('settings/shifts', 'SettingsController@shifts')->name('settings.shifts');
    Route::post('settings/shifts', 'SettingsController@shiftsStore')->name('settings.shifts');
    Route::match(['get', 'post'],'settings/company_info', 'SettingsController@company_info')->name('settings.company_info');
    Route::get('settings/index', 'SettingsController@index_hr')->name('settings.index');
    Route::post('settings/hr_store', 'SettingsController@hr_store')->name('settings.hr_store');
    /*template*/
    Route::get('salary_letter/{id}', 'RequestsController@salary_letter')->name('salary_letter');
    Route::get('alert_letter/{id}', 'DeductionController@alert_letter')->name('alert_letter');
    Route::get('employees/contract_draft/{id}', 'EmployeeController@contract_draft')->name('employees.contract_draft');

});

Route::get('/command', function () {

    /* php artisan migrate */
    \Artisan::call('migrate:fresh --seed');
    \Artisan::call('storage:link');
    dd("Done");
});
Route::get('/migrate', function () {

    /* php artisan migrate */
    \Artisan::call('migrate');
    dd("Done");
});

Route::fallback(function (){
    return view('errors.404-error');
});

