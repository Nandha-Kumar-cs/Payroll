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
        Schema::create('experience_letter', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->string('file_path');
        $table->date('issued_date')->nullable();
        $table->string('file_path')->nullable();
        $table->unsignedBigInteger('issued_by')->nullable();
        $table->timestamps();
        $table->foreign('employee_id')->references('employee')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience_letter');
    }
};
