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
        Schema::create('finish_goods', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->uuid('size_id');
            $table->double('sqm_per_roll',8,2);
            $table->double('roll_quantity',8,2);
            $table->double('total_sqm',10,2);
            $table->string('pallet');
            $table->string('pallet_name');
            $table->string('details');
            $table->double('boxes',8,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finish_goods');
    }
};
