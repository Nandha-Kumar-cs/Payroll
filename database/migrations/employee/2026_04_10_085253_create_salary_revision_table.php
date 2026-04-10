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
        Schema::create('salary_revision', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->decimal('old_salary')->nullable();
        $table->decimal('new_salary');
        $table->date('effective_date');
        $table->string('reason')->nullable();
        $table->unsignedBigInteger('approved_by')->nullable();
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
        Schema::dropIfExists('salary_revision');
    }
};
