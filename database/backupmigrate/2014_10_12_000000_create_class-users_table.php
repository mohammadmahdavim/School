<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('class_user', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
//           $table->foreign('role_id')->references->('id')->on('roles')->onDelete->('cascade');
                $table->integer('class_id')->unsigned();
//            $table->foreign('permission_id')->references->('id')->on('permissions')->onDelete->('cascade');
                $table->primary(['class_id' , 'class_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_user');
    }
}
