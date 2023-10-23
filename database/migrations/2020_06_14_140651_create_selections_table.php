<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selectionss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('selection_items_id');
            $table->foreign('selection_items_id')->references('id')->on('selection_items')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('manager')->nullable();
            $table->dateTime('date')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->boolean('status')->default(1);
            $table->string('permission')->default(1);
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
        Schema::dropIfExists('selections');
    }
}
