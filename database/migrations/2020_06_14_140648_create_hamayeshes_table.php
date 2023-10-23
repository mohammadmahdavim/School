<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHamayeshesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hamayeshes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('manager')->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->boolean('status')->default(1);
            $table->string('permission')->default(1);
            $table->string('context');
            $table->text('items');
            $table->text('address');
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
        Schema::dropIfExists('hamayeshes');
    }
}
