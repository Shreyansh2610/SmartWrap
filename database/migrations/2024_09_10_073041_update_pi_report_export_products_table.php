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
        Schema::table('pi_report_export_products', function (Blueprint $table) {
            $table->renameColumn('rolls_pallet','roll_per_pallet');
            $table->renameColumn('container','weight_per_roll');
            $table->renameColumn('unit','core_weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pi_report_export_products', function (Blueprint $table) {
            $table->renameColumn('roll_per_pallet','rolls_pallet');
            $table->renameColumn('weight_per_roll','container');
            $table->renameColumn('core_weight','unit');
        });
    }
};
