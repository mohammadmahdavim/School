<?php

use Illuminate\Database\Seeder;

class MainPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_pagees')->insert([
            ['name' =>'school','body' => 'مدرسه زیبا','site' =>'myschool.com'],
         ]);
        DB::table('main_pages')->insert([
            ['phone' =>'021349839','email' => 'myschool@gmail.com','day' =>'شنبه تا چهارشنبه','time'=>'از 6 صبح تا 12'],
        ]);
    }
}
