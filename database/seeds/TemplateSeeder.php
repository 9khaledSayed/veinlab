<?php

use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Template::create([
            'arabic_name' => 'مسودة عقد منشأة',
            'english_name' =>'Company Contract Draft',
            'type' => 3,
        ]);
    }
}
