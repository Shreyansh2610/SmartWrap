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
        Schema::create('company_raw_materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('company_name');
            $table->double('total_pallet',8,2);
            $table->double('bag_per_pallet',8,2);
            $table->double('total_bag',10,2);
            $table->double('weight_per_bag',10,2);
            $table->double('total_weight',10,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_raw_materials');
    }
};
