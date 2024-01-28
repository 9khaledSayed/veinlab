<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
         $this->call([
             BranchSeeder::class,
             LabRoleSeeder::class,
             HrRoleSeeder::class,
             EmployeeSeeder::class,
//             DoctorSeeder::class,
//             HomeVisitSeeder::class,
//             HospitalSeeder::class,
//             MainAnalysisSeeder::class,
//             SubAnalysisSeeder::class,
//             CategorySeeder::class
         ]);
    }
}
