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
        Schema::create('salary_component', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->enum('type', ['earning', 'deduction']);
        $table->boolean('is_taxable')->default(false);
        $table->string('formula')->nullable();
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
        Schema::dropIfExists('salary_component');
    }
};
