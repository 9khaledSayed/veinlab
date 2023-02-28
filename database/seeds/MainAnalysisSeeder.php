<?php

use Illuminate\Database\Seeder;

class MainAnalysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\MainAnalysis::class, 800)
            ->has(\App\SubAnalysis::factory()->count(1))
            ->create();
    }
}
