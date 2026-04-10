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
        Schema::create('salary_structure', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->decimal('basic');
        $table->decimal('hra')->default(0);
        $table->decimal('gross')->default(0);
        $table->decimal('net')->default(0);
        $table->date('effective_from');
        $table->decimal('ctc')->nullable();
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
        Schema::dropIfExists('salary_structure');
    }
};
