<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMkarnamehsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_mkarnamehs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('karnameh_id');
            $table->foreign('karnameh_id')->references('id')->on('r_karnamehs')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('dars_id');
            $table->foreign('dars_id')->references('id')->on('dars')->onDelete('cascade');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('mark');
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_mkarnamehs');
    }
}
