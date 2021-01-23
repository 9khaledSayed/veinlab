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
                'label' => 'View ' . $caption
            ]);
            \App\Ability::create([
                'name'  => 'show_' . $caption,
                'label' => 'Show ' . $caption
            ]);
            \App\Ability::create([
                'name'  => 'create_' . $caption,
                'label' => 'Create ' . $caption
            ]);
            \App\Ability::create([
                'name'  => 'update_' . $caption,
                'label' => 'Update ' . $caption
            ]);
            \App\Ability::create([
                'name'  => 'delete_' . $caption,
                'label' => 'Delete ' . $caption
            ]);
        }
        /*Waiting_lab abilities*/
        \App\Ability::create([
            'name'  => 'view_waiting_labs',
            'label' => 'View Waiting Lab'
        ]);

        /*profits abilities*/
        \App\Ability::create([
            'name'  => 'view_profits',
            'label' => 'View Profits'
        ]);
        /*profits abilities*/
        \App\Ability::create([
            'name'  => 'view_statistics',
            'label' => 'View Statistics'
        ]);

        /*reports abilities*/
        \App\Ability::create([
            'name'  => 'view_reports',
            'label' => 'View Reports'
        ]);

        /*Invoices abilities*/
        \App\Ability::create([
            'name'  => 'view_invoices',
            'label' => 'View Invoices'
        ]);
        \App\Ability::create([
            'name'  => 'show_invoices',
            'label' => 'Show Invoices'
        ]);
        \App\Ability::create([
            'name'  => 'delete_invoices',
            'label' => 'Delete Invoices'
        ]);

        /*Sittings abilities*/
        \App\Ability::create([
            'name'  => 'view_sittings',
            'label' => 'View Sittings'
        ]);
        /*Logs abilities*/
        \App\Ability::create([
            'name'  => 'view_logs',
            'label' => 'View Logs'
        ]);


        \App\Ability::create([
            'name'  => 'waiting_lab_notifications',
            'label' => 'Waiting Lab Notifications'
        ]);

        \App\Ability::create([
            'name'  => 'doctor_notifications',
            'label' => 'Doctor Notifications'
        ]);

        \App\Ability::create([
            'name'  => 'reject_results',
            'label' => 'Reject Result'
        ]);
    }
}
