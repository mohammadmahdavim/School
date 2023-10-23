<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJTamrins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('j_tamrins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
//            $table->foreign('class_id')->references('classnamber')->on('clas')->onDelete('cascade');
            $table->unsignedBigInteger('tamrin_id');
            $table->foreign('tamrin_id')->references('id')->on('tamrins')->onDelete('cascade');
            $table->string('namedars');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
            $table->string('description')->nullable();
            $table->string('daraje')->nullable();
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
        Schema::dropIfExists('j_tamrins');
    }
}
