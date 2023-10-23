<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('issue')->unique()->comment('شماره کتاب');
            $table->bigInteger('count')->comment('تعداد کتاب');
            $table->string('name')->comment('نام کتاب');
            $table->string('author')->comment('نام نویسنده');
            $table->string('Publisher')->comment('نام ناشر');
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
        Schema::dropIfExists('libraries');
    }
}
