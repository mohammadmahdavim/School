<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCKarnamehsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_karnamehs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('id_karnameh');
            $table->foreign('id_karnameh')->references('id')->on('r_karnamehs')->onDelete('cascade');
            $table->unsignedBigInteger('class_id');
//            $table->foreign('class_id')->references('classnamber')->on('clas')->onDelete('cascade');
            $table->unsignedBigInteger('dars_id');
            $table->foreign('dars_id')->references('id')->on('dars')->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('c_marks')->onDelete('cascade');
            $table->float('percent');
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
        Schema::dropIfExists('c_karnamehs');
    }
}
