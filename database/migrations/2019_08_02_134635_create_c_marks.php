<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('classid');
//            $table->foreign('class_id')->references('id')->on('clas')->onDelete('cascade');
            $table->unsignedBigInteger('dars');
            $table->foreign('dars')->references('id')->on('dars')->onDelete('cascade');
            $table->string('namedars');
            $table->string('payeclass');
            $table->integer('max')->default(20);
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
        Schema::dropIfExists('c_marks');
    }
}
