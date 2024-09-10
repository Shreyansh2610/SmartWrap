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
        Schema::table('finish_goods', function (Blueprint $table) {
            $table->renameColumn('sqm_per_roll','kg_per_roll');
            $table->renameColumn('total_sqm','total_kg');
            $table->renameColumn('pallet','number_of_pallet');
            $table->renameColumn('pallet_name','pallet_number');
            $table->renameColumn('order_purchase_date','production_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finish_goods', function (Blueprint $table) {
            $table->renameColumn('kg_per_roll','sqm_per_roll');
            $table->renameColumn('total_kg','total_sqm');
            $table->renameColumn('number_of_pallet','pallet');
            $table->renameColumn('pallet_number','pallet_name');
            $table->renameColumn('production_date','order_purchase_date');
        });
    }
};
