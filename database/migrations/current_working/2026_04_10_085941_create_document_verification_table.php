<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_verification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_document_id');
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();

            // foregin key constrain
            $table->foreign('employee_document_id')->references('id')->on('employee_document');
            $table->foreign('employee_id')->references('id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_verification');
    }
};
