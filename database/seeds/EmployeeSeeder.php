<?php

use App\Ability;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $employee1 = \App\Employee::create([
            'fname_arabic'      => 'Admin',
            'lname_arabic'      => 'Admin',
            'fname_english'      => 'Admin',
            'lname_english'      => 'Admin',
            'birthdate'      => '2020-08-01',
            'joined_date'      => '2020-08-01',
            'nationality_id'      => '0',
            'branch_id'      => '1',
            'id_num'      => '54566546544',
            'emp_num'      => '2121',
            'contract_type'      => '1',
            'start_date'      => '2020-08-01',
            'contract_period'      => '12',
            'basic_salary'      => '3000',
            'phone'      => '0512345678',
            'is_master'      => true,
            'shift_type'   =>1,
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('password'),
        ]);
//        $employee2 = \App\Employee::create([
//            'fname_arabic'      => 'Receptionist',
//            'lname_arabic'      => 'Receptionist',
//            'fname_english'      => 'Receptionist',
//            'lname_english'      => 'Receptionist',
//            'birthdate'      => '2020-08-01',
//            'joined_date'      => '2020-08-01',
//            'nationality_id'      => '0',
//            'id_num'      => '54566546544',
//            'emp_num'      => '2122',
//            'branch_id'      => '1',
//            'contract_type'      => '1',
//            'start_date'      => '2020-08-01',
//            'contract_period'      => '12',
//            'basic_salary'      => '3000',
//            'phone'      => '01021212121',
//            'shift_type'   =>1,
//            'email'     => 'receptionist@example.com',
//            'password'  => Hash::make(12345678),
//        ]);
//        $employee3 = \App\Employee::create([
//            'fname_arabic'      => 'Accountant',
//            'lname_arabic'      => 'Accountant',
//            'fname_english'      => 'Accountant',
//            'lname_english'      => 'Accountant',
//            'branch_id'      => '1',
//            'birthdate'      => '2020-08-01',
//            'joined_date'      => '2020-08-01',
//            'nationality_id'      => '0',
//            'id_num'      => '54566546544',
//            'emp_num'      => '2123',
//            'contract_type'      => '1',
//            'start_date'      => '2020-08-01',
//            'contract_period'      => '12',
//            'basic_salary'      => '3000',
//            'phone'      => '01021212121',
//            'shift_type'   =>1,
//            'email'     => 'accountant@example.com',
//            'password'  => Hash::make(12345678),
//        ]);
//        $employee4 = \App\Employee::create([
//            'fname_arabic'      => 'Lab',
//            'lname_arabic'      => 'Lab',
//            'fname_english'      => 'Lab',
//            'lname_english'      => 'Lab',
//            'birthdate'      => '2020-08-01',
//            'joined_date'      => '2020-08-01',
//            'nationality_id'      => '0',
//            'branch_id'      => '1',
//            'id_num'      => '54566546544',
//            'emp_num'      => '2121',
//            'contract_type'      => '1',
//            'start_date'      => '2020-08-01',
//            'contract_period'      => '12',
//            'basic_salary'      => '3000',
//            'phone'      => '01021212121',
//            'shift_type'   =>1,
//            'email'     => 'Lab@example.com',
//            'password'  => Hash::make(12345678),
//        ]);
//        $employee5 = \App\Employee::create([
//            'fname_arabic'      => 'Doctor',
//            'lname_arabic'      => 'Doctor',
//            'fname_english'      => 'Doctor',
//            'lname_english'      => 'Doctor',
//            'birthdate'      => '2020-08-01',
//            'joined_date'      => '2020-08-01',
//            'nationality_id'      => '0',
//            'branch_id'      => '1',
//            'id_num'      => '54566546544',
//            'emp_num'      => '2121',
//            'contract_type'      => '1',
//            'start_date'      => '2020-08-01',
//            'contract_period'      => '12',
//            'basic_salary'      => '3000',
//            'phone'      => '01021212121',
//            'shift_type'   =>1,
//            'email'     => 'doctor@example.com',
//            'password'  => Hash::make(12345678),
//        ]);
        $Super_Admin = Role::create([
            'name_english'  => 'Super Admin',
            'name_arabic'  => 'المدير التنفيذي',
            'type'   => 1,
            'system' => 'lab'
        ]);
        $Receptionist = Role::create([
            'name_english'  => 'Receptionist',
            'name_arabic'  => 'موظف الاستقبال',
            'type'   => 1,
            'system' => 'lab'
        ]);
        $lab = Role::create([
            'name_english'  => 'Lab',
            'name_arabic'  => 'موظف المختبر',
            'type'   => 1,
            'system' => 'lab'
        ]);
        $Accountant = Role::create([
            'name_english'  => 'Accountant',
            'name_arabic'  => 'المحاسب',
            'type'   => 1,
            'system' => 'lab'
        ]);
        $Doctor = Role::create([
            'name_english'  => 'Doctor',
            'name_arabic'  => 'طبيب',
            'type'   => 1,
            'system' => 'lab'
        ]);
        $Hr_role = Role::create([
            'name_english'  => 'Hr',
            'name_arabic'  => 'شئون الموظفين',
            'type'   => 1,
            'system' => 'hr'
        ]);
        $abilities = Ability::get();
        foreach($abilities as $ability){
            $Super_Admin->allowTo($ability);
        }

        $Receptionist->allowTo("view_patients");
        $Receptionist->allowTo("show_patients");
        $Receptionist->allowTo("create_patients");
        $Receptionist->allowTo("update_patients");
        $Receptionist->allowTo("view_home_visits");
        $Receptionist->allowTo("show_home_visits");
        $Receptionist->allowTo("create_home_visits");
        $Receptionist->allowTo("update_home_visits");
        $Receptionist->allowTo("view_invoices");
        $Receptionist->allowTo("show_invoices");

        $lab->allowTo("view_results");
        $lab->allowTo("show_results");
        $lab->allowTo("create_results");
        $lab->allowTo("update_results");
        $lab->allowTo("delete_results");
        $lab->allowTo("waiting_lab_notifications");

        $lab->allowTo("view_waiting_labs");

        $lab->allowTo("view_main_analysis");
        $lab->allowTo("show_main_analysis");
        $lab->allowTo("update_main_analysis");

        $lab->allowTo("view_sub_analysis");
        $lab->allowTo("show_sub_analysis");
        $lab->allowTo("create_sub_analysis");
        $lab->allowTo("update_sub_analysis");
        $lab->allowTo("delete_sub_analysis");

        $Accountant->allowTo("view_invoices");
        $Accountant->allowTo("show_invoices");

        $Accountant->allowTo("view_exports");
        $Accountant->allowTo("show_exports");
        $Accountant->allowTo("create_exports");
        $Accountant->allowTo("update_exports");
        $Accountant->allowTo("view_revenue");
        $Accountant->allowTo("show_revenue");
        $Accountant->allowTo("create_revenue");
        $Accountant->allowTo("update_revenue");

        $Accountant->allowTo("view_profits");
        $Accountant->allowTo("view_reports");

        $Doctor->allowTo("view_results");
        $Doctor->allowTo("show_results");
        $Doctor->allowTo("doctor_notifications");


        $Doctor->allowTo("view_main_analysis");
        $Doctor->allowTo("show_main_analysis");
        $Doctor->allowTo("update_main_analysis");

        $Doctor->allowTo("view_sub_analysis");
        $Doctor->allowTo("show_sub_analysis");
        $Doctor->allowTo("create_sub_analysis");
        $Doctor->allowTo("update_sub_analysis");
        $Doctor->allowTo("delete_sub_analysis");



        $Hr_role->allowTo("salary_induction");
        $Hr_role->allowTo("vacation_request");
        $Hr_role->allowTo("Ask_for_permission");
        $Hr_role->allowTo("Request_a_trip");
        $Hr_role->allowTo("Debt_Request");
        $Hr_role->allowTo("Request_a_complaint");
        $Hr_role->allowTo("view_my_requests");
        $Hr_role->allowTo("view_my_vacations");
        $Hr_role->allowTo("view_my_salaries");
        $Hr_role->allowTo("view_attendance_sheet");
        $Hr_role->allowTo("view_my_attendance");

        $employee1->assignRole($Super_Admin);
//        $employee2->assignRole($Receptionist);
//        $employee3->assignRole($Accountant);
//        $employee4->assignRole($lab);
//        $employee5->assignRole($Doctor);

        factory(\App\Employee::class, 1000)->create()->each(function ($user) {
            $user->employee_requests()->save(factory(\App\HR\EmployeeRequest::class)->make());
        });
    }
}
