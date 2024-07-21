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
        Schema::table('company_raw_materials', function (Blueprint $table) {
            $table->longText('supplier_name')->after('total_weight');
            $table->longText('purchase_order_no')->after('supplier_name');
            $table->longText('sales_order_no')->after('purchase_order_no');
            $table->longText('description_of_goods')->after('sales_order_no');
            $table->double('qty',8,2)->after('description_of_goods');
            $table->double('weight_per_pcs',8,2)->after('qty');
            $table->longText('payment_terms')->after('weight_per_pcs');
            $table->date('invoice_date')->after('payment_terms');
            $table->longText('status')->after('invoice_date');
            $table->date('received_date')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_raw_materials', function (Blueprint $table) {
            $table->dropColumn([
                'supplier_name',
                'purchase_order_no',
                'sales_order_no',
                'description_of_goods',
                'qty',
                'weight_per_pcs',
                'payment_terms',
                'invoice_date',
                'status',
                'received_date'
            ]);
        });
    }
};
