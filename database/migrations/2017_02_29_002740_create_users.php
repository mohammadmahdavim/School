<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('codemeli')->unique();
            $table->bigInteger('shomarande')->nullable();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('fname')->nullable();
            $table->string('sex')->nullable();
            $table->string('paye')->nullable();
            $table->string('class')->nullable();
            $table->date('birthday')->nullable();
            $table->dateTime('sabttime')->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('level')->nullable();
            $table->integer('status')->nullable();
            $table->string('role')->nullable();
            $table->string('mime')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('resizeimage')->nullable();
            $table->string('filename')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('expire_token')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
        });
//        \Illuminate\Support\Facades\Artisan::call('db:seed', [
//            '--class' => UserSeeder::class,
//        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
