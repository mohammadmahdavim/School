<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_images', function (Blueprint $table) {
            $table->Increments('id')->unsigned();
            $table->integer('matlab_id')->unsigned();
            $table->foreign('matlab_id')->references('id')->on('homes')->onDelete('cascade');
            $table->string('mime');
            $table->string('original_filename');
            $table->string('resize_image');
            $table->string('filename');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_images');
    }
}
