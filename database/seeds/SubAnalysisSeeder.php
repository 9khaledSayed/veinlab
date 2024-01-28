<?php

use Illuminate\Database\Seeder;

class SubAnalysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\SubAnalysis::class, 5)->create();
    }
}
