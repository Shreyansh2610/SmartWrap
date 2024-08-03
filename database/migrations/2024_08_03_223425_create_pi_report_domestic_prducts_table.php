<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pi_report_domestic_prducts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pi_report_domestic_id');
            $table->longText('description')->nullable();
            $table->string('hsn_code')->nullable();
            $table->string('no_of_box')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('rate')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pi_report_domestic_prducts');
    }
};
