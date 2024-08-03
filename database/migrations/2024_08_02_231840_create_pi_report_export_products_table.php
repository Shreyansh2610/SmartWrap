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
        Schema::create('pi_report_export_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pi_report_export_id');
            $table->string('size')->nullable();
            $table->string('type')->nullable();
            $table->string('packaging_description')->nullable();
            $table->string('rolls_pallet')->nullable();
            $table->string('no_of_pallets')->nullable();
            $table->string('total_rolls')->nullable();
            $table->string('container')->nullable();
            $table->string('quanity')->nullable();
            $table->string('unit')->nullable();
            $table->string('rate_in_usd')->nullable();
            $table->string('amount_in_usd')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pi_report_export_products');
    }
};
