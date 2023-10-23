<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('gateway_id')->unsigned()->nullable();
            $table->foreign('gateway_id')->references('id')->on('gateways')->onDelete('cascade');
            $table->string('token');
            $table->string('date');
            $table->string('trans_id')->nullable();
            $table->string('id_get')->nullable();
            $table->enum('type',['online', 'discount', 'wallet', 'local']);
            $table->enum('status',['success','failed','waiting','local','cancel'])->default('waiting');
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
        Schema::dropIfExists('payments');
    }
}
