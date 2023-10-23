<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->enum('type',['online','offline'])->default('online');
            $table->string('image')->nullable();
            $table->text('config');
            $table->tinyInteger('default')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('wallet')->default(0);
            $table->integer('limit_cost')->default(0); // 0 => unlimited
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateways');
    }
}
