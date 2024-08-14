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
            $table->double('sqm_per_roll',8,2)->nullable()->change();
            $table->double('roll_quantity',8,2)->nullable()->change();
            $table->double('total_sqm',10,2)->nullable()->change();
            $table->string('pallet')->nullable()->change();
            $table->string('pallet_name')->nullable()->change();
            $table->string('details')->nullable()->change();
            $table->double('boxes',8,2)->nullable()->change();
            $table->date('order_purchase_date')->after('boxes')->nullable()->change();
            $table->longText('good_details')->after('order_purchase_date')->nullable()->change();
            $table->longText('company')->after('good_details')->nullable()->change();
            $table->longText('description_of_goods')->after('company')->nullable()->change();
            $table->double('qty_in_storage_start',8,2)->after('description_of_goods')->nullable()->change();
            $table->double('qty_issued',8,2)->after('description_of_goods')->nullable()->change();
            $table->double('qty_in_storage_end',8,2)->after('description_of_goods')->nullable()->change();
            $table->double('qty_returned',8,2)->after('description_of_goods')->nullable()->change();
            $table->double('wastage',8,2)->after('description_of_goods')->nullable()->change();
            $table->double('actual_qty_consumed',8,2)->after('description_of_goods')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finish_goods', function (Blueprint $table) {

        });
    }
};
