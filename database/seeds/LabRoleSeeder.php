<?php

use Illuminate\Database\Seeder;

class LabRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $captions  = [
            'roles',
            'hospitals',
            'doctors',
            'companies',
            'nationalities',
            'patients',
            'results',
            'main_analysis',
            'sub_analysis',
            'home_visits',
            'stocks',
            'packages',
            'promo_codes',
            'exports',
            'revenue',
        ];
        foreach ($captions as $caption) {
            \App\Ability::create([
                'name'  => 'view_' . $caption,
                'label' => 'View ' . $caption,
                 'category' => $caption
            ]);
            \App\Ability::create([
                'name'  => 'show_' . $caption,
                'label' => 'Show ' . $caption
            ]);
            \App\Ability::create([
                'name'  => 'create_' . $caption,
                'label' => 'Create ' . $caption,
                'category' => $caption
            ]);
            \App\Ability::create([
                'name'  => 'update_' . $caption,
                'label' => 'Update ' . $caption,
                'category' => $caption
            ]);
            \App\Ability::create([
                'name'  => 'delete_' . $caption,
                'label' => 'Delete ' . $caption,
                'category' => $caption
            ]);
        }
        /*Waiting_lab abilities*/
        \App\Ability::create([
            'name'  => 'view_waiting_labs',
            'label' => 'View Waiting Lab',
            'category' => 'view_waiting_labs'
        ]);

        /*profits abilities*/
        \App\Ability::create([
            'name'  => 'view_profits',
            'label' => 'View Profits',
            'category' => 'view_profits'
        ]);
        /*profits abilities*/
        \App\Ability::create([
            'name'  => 'view_statistics',
            'label' => 'View Statistics',
            'category' => 'view_statistics'
        ]);

        /*reports abilities*/
        \App\Ability::create([
            'name'  => 'view_reports',
            'label' => 'View Reports',
            'category' => 'view_reports'
        ]);

        /*Invoices abilities*/
        \App\Ability::create([
            'name'  => 'view_invoices',
            'label' => 'View Invoices',
            'category' => 'view_invoices'
        ]);
        \App\Ability::create([
            'name'  => 'show_invoices',
            'label' => 'Show Invoices',
            'category' => 'show_invoices'
        ]);
        \App\Ability::create([
            'name'  => 'delete_invoices',
            'label' => 'Delete Invoices',
            'category' => 'delete_invoices'
        ]);

        /*Sittings abilities*/
        \App\Ability::create([
            'name'  => 'view_sittings',
            'label' => 'View Sittings',
            'category' => 'view_sittings'
        ]);
        /*Logs abilities*/
        \App\Ability::create([
            'name'  => 'view_logs',
            'label' => 'View Logs',
            'category' => 'view_logs'
        ]);


        \App\Ability::create([
            'name'  => 'waiting_lab_notifications',
            'label' => 'Waiting Lab Notifications',
            'category' => 'waiting_lab_notifications'
        ]);

        \App\Ability::create([
            'name'  => 'doctor_notifications',
            'label' => 'Doctor Notifications',
            'category' => 'doctor_notifications'
        ]);

        \App\Ability::create([
            'name'  => 'reject_results',
            'label' => 'Reject Result',
            'category' => 'reject_results'
        ]);
    }
}
