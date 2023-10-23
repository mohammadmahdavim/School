<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_optionss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('selection_id');
            $table->foreign('selection_id')->references('id')->on('selections')->ondelete('cascade');
            $table->unsignedBigInteger('selection_items_id');
            $table->foreign('selection_items_id')->references('id')->on('selection_items')->onDelete('cascade');
            $table->string('name');
            $table->string('file')->nullable();
            $table->text('description')->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('selection_options');
    }
}
