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
        Schema::create('sizes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('size_in_cm');
            $table->integer('size_in_mm');
            $table->string('product_name');
            $table->string('hsn_code');
            $table->string('thickness');
            $table->integer('micron');
            $table->string('grade')->nullable();
            $table->string('width')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
