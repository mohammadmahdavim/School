<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myexams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
//            $table->unsignedBigInteger('class_id');
//            $table->foreign('class_id')->references('id')->on('clas')->onDelete('cascade');
//            $table->unsignedBigInteger('dars_id');
//            $table->foreign('dars_id')->references('id')->on('dars')->onDelete('cascade');
            $table->string('title');
            $table->boolean('status')->default(1);
            $table->date('expire');
            $table->string('time');
            $table->tinyInteger('archive')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
