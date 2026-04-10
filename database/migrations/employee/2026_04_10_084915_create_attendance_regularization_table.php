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
        Schema::create('attendance_regularization', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('attendance_id');
        $table->unsignedBigInteger('employee_id');
        $table->string('reason');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->date('requested_at')->default(now());
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
        Schema::dropIfExists('attendance_regularization');
    }
};
