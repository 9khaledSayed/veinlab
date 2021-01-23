<?php

use Illuminate\Database\Seeder;

class HomeVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\HomeVisit::class, 5)->create();
    }
}
