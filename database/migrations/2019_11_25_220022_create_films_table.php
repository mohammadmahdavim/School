<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('class_id')->unsigned()->nullable();
            $table->boolean('auther')->unsigned();
            $table->integer('chapter')->unsigned();
            $table->bigInteger('price')->unsigned();
            $table->bigInteger('downloadcount')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('dars')->nullable();
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('films');
    }
}
