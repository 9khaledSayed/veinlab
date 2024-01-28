<?php

use Illuminate\Database\Seeder;

class NormalRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\NormalRange::class, 5)->create();
    }
}
