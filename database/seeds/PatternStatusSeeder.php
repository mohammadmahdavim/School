<?php

use Illuminate\Database\Seeder;

class PatternStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          \App\patternStatus ::create(['name' => 'پیش مطالعه']);
          \App\patternStatus ::create(['name' => 'مطالعه']);
          \App\patternStatus ::create(['name' => 'حل تمرین تستی']);
          \App\patternStatus ::create(['name' => 'حل تمرین تشریحی']);
          \App\patternStatus ::create(['name' => 'آزمون']);



    }
}
