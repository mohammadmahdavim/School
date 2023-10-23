<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            ['f_name' =>'test1','l_name' => 'test1','paye'=>'','class'=>'','fname'=>'test1','email'=>'test1@gmail.com','mobile'=>'09121111111','codemeli'=>'1234567890','password'=>bcrypt('1111'),'level'=>'admin','role'=>'مدیر'],
            ['f_name' =>'test2','l_name' => 'test2','paye'=>'','class'=>'','fname'=>'test1','email'=>'test2@gmail.com','mobile'=>'09121111110','codemeli'=>'1234567899','password'=>bcrypt('1111'),'level'=>'یوزر','role'=>'معلم'],
            ['f_name' =>'test3','l_name' => 'test3','paye'=>'','class'=>'','fname'=>'test3','email'=>'test3@gmail.com','mobile'=>'09121111110','codemeli'=>'3234567899','password'=>bcrypt('1111'),'level'=>'یوزر','role'=>'معلم'],
            ['f_name' =>'test4','l_name' => 'test4','paye'=>'','class'=>'','fname'=>'test4','email'=>'test2@gmail.com','mobile'=>'09121111110','codemeli'=>'2234567899','password'=>bcrypt('1111'),'level'=>'یوزر','role'=>'معلم'],

            ]);

        \Illuminate\Support\Facades\DB::table('teachers')->insert([
            ['user_id' =>'1','class_id' => '1'],
            ['user_id' =>'2','class_id' => '1'],
            ['user_id' =>'3','class_id' => '1'],
        ]);
    }
}
