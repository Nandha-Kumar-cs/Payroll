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
        Schema::create('leave_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->unsignedBigInteger('leave_type_id');
        $table->date('from_date');
        $table->date('to_date');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->dateTime('applied_at')->default(now());
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
        Schema::dropIfExists('leave_requests');
    }
};
