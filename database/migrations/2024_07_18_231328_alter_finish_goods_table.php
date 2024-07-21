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
            $table->date('order_purchase_date')->after('boxes');
            $table->longText('good_details')->after('order_purchase_date');
            $table->longText('company')->after('good_details');
            $table->longText('description_of_goods')->after('company');
            $table->double('qty_in_storage_start',8,2)->after('description_of_goods');
            $table->double('qty_issued',8,2)->after('description_of_goods');
            $table->double('qty_in_storage_end',8,2)->after('description_of_goods');
            $table->double('qty_returned',8,2)->after('description_of_goods');
            $table->double('wastage',8,2)->after('description_of_goods');
            $table->double('actual_qty_consumed',8,2)->after('description_of_goods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finish_goods', function (Blueprint $table) {
            $table->dropColumn([
                'order_purchase_date',
                'good_details',
                'company',
                'description_of_goods',
                'qty_in_storage_start',
                'qty_issued',
                'qty_in_storage_end',
                'qty_returned',
                'wastage',
                'actual_qty_consumed',
            ]);
        });
    }
};
