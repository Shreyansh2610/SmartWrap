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
        Schema::create('po_report_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('po_report_id');
            $table->longText('product_description');
            $table->string('hsn_code');
            $table->string('quantity');
            $table->string('unit');
            $table->string('rate');
            $table->string('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_report_products');
    }
};
