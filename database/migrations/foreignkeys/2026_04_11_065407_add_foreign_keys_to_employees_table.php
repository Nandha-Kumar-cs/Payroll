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
         Schema::table('employee', function (Blueprint $table) {

            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments');

            $table->foreign('designation_id')
                  ->references('id')
                  ->on('designations');

            $table->foreign('reporting_manager_id')
                  ->references('id')
                  ->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
        });
    }
};
