<?php

use Illuminate\Database\Seeder;

class HrRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'employees',
            'employees_services',
            'requests',
            'vacations',
            'salaries',
            'decisions',
            'attendance',
            'memos',
        ];

        /*employees*/
        \App\Ability::create([
            'name'  => 'view_employees',
            'label' => 'View Employees',
            'category' => 'employees'
        ]);
        \App\Ability::create([
            'name'  => 'create_employees',
            'label' => 'Create Employees',
            'category' => 'employees'
        ]);
        \App\Ability::create([
            'name'  => 'show_employees',
            'label' => 'Show Employees',
            'category' => 'employees'
        ]);
        \App\Ability::create([
            'name'  => 'Update_employees',
            'label' => 'Update Employees',
            'category' => 'employees'
        ]);

        /*Employees services*/
//        \App\Ability::create([
//            'name'  => 'create_employees_services',
//            'label' => 'Create Employees Services',
//            'category' => 'employees_services'
//        ]);
        \App\Ability::create([
            'name'  => 'salary_induction',
            'label' => 'Salary Induction',
            'category' => 'employees_services'
        ]);
        \App\Ability::create([
            'name'  => 'vacation_request',
            'label' => 'vacation request',
            'category' => 'employees_services'
        ]);
        \App\Ability::create([
            'name'  => 'Ask_for_permission',
            'label' => 'Ask for permission',
            'category' => 'employees_services'
        ]);
        \App\Ability::create([
            'name'  => 'Request_a_trip',
            'label' => 'Request a trip',
            'category' => 'employees_services'
        ]);
        \App\Ability::create([
            'name'  => 'Debt_Request',
            'label' => 'Debt Request',
            'category' => 'employees_services'
        ]);
        \App\Ability::create([
            'name'  => 'Request_a_complaint',
            'label' => 'Request a complaint',
            'category' => 'employees_services'
        ]);

        /*Requests*/
        \App\Ability::create([
            'name'  => 'view_my_requests',
            'label' => 'View My Requests',
            'category' => 'requests'
        ]);
        \App\Ability::create([
            'name'  => 'view_pending_requests',
            'label' => 'View Pending Requests',
            'category' => 'requests'
        ]);
        \App\Ability::create([
            'name'  => 'view_employees_requests',
            'label' => 'View Employees Requests',
            'category' => 'requests'
        ]);

        /* Vacations */
        \App\Ability::create([
            'name'  => 'view_my_vacations',
            'label' => 'View My Vacations',
            'category' => 'vacations'
        ]);
        \App\Ability::create([
            'name'  => 'create_vacations',
            'label' => 'Create Vacations',
            'category' => 'vacations'
        ]);
        \App\Ability::create([
            'name'  => 'view_employees_vacations',
            'label' => 'View Employees Vacations',
            'category' => 'vacations'
        ]);
        \App\Ability::create([
            'name'  => 'view_vacations_Balances',
            'label' => 'View Vacations Balances',
            'category' => 'vacations'
        ]);

        /*Salaries*/
        \App\Ability::create([
            'name'  => 'view_all_salaries',
            'label' => 'View All Salaries',
            'category' => 'salaries'
        ]);
        \App\Ability::create([
            'name'  => 'view_my_salaries',
            'label' => 'View My Salaries',
            'category' => 'salaries'
        ]);
        \App\Ability::create([
            'name'  => 'view_pending_reports',
            'label' => 'View Pending Reports',
            'category' => 'salaries'
        ]);
        \App\Ability::create([
            'name'  => 'view_deductions',
            'label' => 'View Deductions',
            'category' => 'salaries'
        ]);
        \App\Ability::create([
            'name'  => 'view_additions',
            'label' => 'View Additions',
            'category' => 'salaries'
        ]);
        \App\Ability::create([
            'name'  => 'view_loans',
            'label' => 'View Loans / Debt',
            'category' => 'salaries'
        ]);

        /*Decisions*/
        \App\Ability::create([
            'name'  => 'view_terminated_employees',
            'label' => 'View Terminated Employees',
            'category' => 'decisions'
        ]);
        \App\Ability::create([
            'name'  => 'end_employee_service',
            'label' => 'End Employee Service',
            'category' => 'decisions'
        ]);
        \App\Ability::create([
            'name'  => 'view_suspended_salaries',
            'label' => 'View Suspended Salaries',
            'category' => 'decisions'
        ]);
        \App\Ability::create([
            'name'  => 'suspend_employee_salary',
            'label' => 'Suspend Employee Salary',
            'category' => 'decisions'
        ]);
        \App\Ability::create([
            'name'  => 'view_my_decisions',
            'label' => 'View My Decisions',
            'category' => 'decisions'
        ]);
        \App\Ability::create([
            'name'  => 'view_all_decisions',
            'label' => 'View All Decisions',
            'category' => 'decisions'
        ]);
        \App\Ability::create([
            'name'  => 'view_all_decisions',
            'label' => 'View All Decisions',
            'category' => 'decisions'
        ]);

        /*Attendance*/
        \App\Ability::create([
            'name'  => 'view_check_in_page',
            'label' => 'View Check-in Page',
            'category' => 'attendance'
        ]);
        \App\Ability::create([
            'name'  => 'view_attendance_sheet',
            'label' => 'View Attendance Sheet',
            'category' => 'attendance'
        ]);
        \App\Ability::create([
            'name'  => 'view_my_attendance',
            'label' => 'View My Attendance',
            'category' => 'attendance'
        ]);
        /*Memos*/
        \App\Ability::create([
            'name'  => 'view_all_memos',
            'label' => 'View All Memos',
            'category' => 'memos'
        ]);
        \App\Ability::create([
            'name'  => 'view_my_memos',
            'label' => 'View My Memos',
            'category' => 'memos'
        ]);
        \App\Ability::create([
            'name'  => 'create_memos',
            'label' => 'Create Memos',
            'category' => 'memos'
        ]);
        /*Settings*/
        \App\Ability::create([
            'name'  => 'view_company_info',
            'label' => 'View Company Info',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_branches',
            'label' => 'View Branches',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_work_shifts',
            'label' => 'View Work Shifts',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_holidays',
            'label' => 'View Holidays',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_users',
            'label' => 'View Users',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_system_settings',
            'label' => 'View System Settings',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_templates',
            'label' => 'View Templates',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_Roles',
            'label' => 'View Roles',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_ded_add_types',
            'label' => 'View Deductions / Additions Types',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_days_off',
            'label' => 'View Days off',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_salary_release_day',
            'label' => 'View Salary Release Day',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_leave_types',
            'label' => 'View Leave Types',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_working_hours',
            'label' => 'View Working Hours',
            'category' => 'settings'
        ]);
        \App\Ability::create([
            'name'  => 'view_allowances_types',
            'label' => 'View Allowances Types',
            'category' => 'settings'
        ]);

    }
}
