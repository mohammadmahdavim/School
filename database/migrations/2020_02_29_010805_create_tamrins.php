<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTamrins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamrins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('dars');
            $table->foreign('dars')->references('id')->on('dars')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
//            $table->foreign('class_id')->references('classnamber')->on('clas')->onDelete('cascade');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
            $table->string('pfilename');
            $table->string('poriginal_filename');
            $table->string('pmime')->nullable();
            $table->boolean('status')->default(0);
            $table->date('expire');
            $table->tinyInteger('archive')->default(0);
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
        Schema::dropIfExists('tamrins');
    }
}
