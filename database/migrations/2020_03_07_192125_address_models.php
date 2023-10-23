<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddressModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('home_id')->unsigned();
            $table->foreign('home_id')->references('id')->on('homes')->onDelete('cascade');
            $table->string('gmail')->nullable();
            $table->string('yahoo')->nullable();
            $table->string('ins')->nullable();
            $table->string('tel')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
