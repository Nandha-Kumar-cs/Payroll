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
        Schema::create('offer_letter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->decimal('offered_salary')->nullable();
            $table->string('file_path');
            $table->date('issued_date');
            $table->boolean('accepted')->default(false);
            $table->timestamps();

            // constraint
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
        Schema::dropIfExists('offer_letter');
    }
};
