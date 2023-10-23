<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarnamehs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barnamehs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('clas')->onDelete('cascade');
            $table->unsignedBigInteger('classnumber');
//            $table->foreign('classnumber')->references('classnamber')->on('clas')->onDelete('cascade');
            $table->string('category');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
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
        Schema::dropIfExists('barnamehs');
    }
}
