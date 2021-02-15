<?php

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\HR\Branch::create([
            'name'      => 'فرع الرياض',
            'address'      => 'المجمعة : طريق الأمير نايف بن عبدالعزيز',
        ]);
    }
}
