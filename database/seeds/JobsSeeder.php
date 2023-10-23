<?php

use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            ['user_id' =>1,'job' => 'رسیدگی به اموال مدرسه'],
            ['user_id' =>1,'job' => 'برگزاری جلسه اولیا سوم'],
            ['user_id' =>1,'job' => 'تخلیه انباری مدرسه'],
            ['user_id' =>1,'job' => 'بررسی چک های مدرسه'],
            ['user_id' =>1,'job' => 'آگهی استخدام نگهبان'],
            ['user_id' =>1,'job' => 'تغییر تایم زنگ تفریح'],

        ]);
    }
}
