<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission' , function(Blueprint $table){
            $table->id('id');
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('permission_id')->unsigned();
            // foreign key reference
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('permission_id')->references('permission_id')->on('permissions');

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
};
