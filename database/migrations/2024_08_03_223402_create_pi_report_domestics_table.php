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
        Schema::create('pi_report_domestics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pi_no');
            $table->date('date')->nullable();
            $table->string('buyer_order_no')->nullable();
            $table->date('buyer_order_date')->nullable();
            $table->string('supplier_name')->nullable();
            $table->longText('supplier_address')->nullable();
            $table->string('supplier_pan')->nullable();
            $table->string('supplier_gst')->nullable();
            $table->string('supplier_mail')->nullable();
            $table->string('supplier_contact_person')->nullable();
            $table->string('supplier_contact_no')->nullable();
            $table->string('consignee_name')->nullable();
            $table->longText('consignee_address')->nullable();
            $table->string('consignee_pan')->nullable();
            $table->string('consignee_iec')->nullable();
            $table->string('consignee_gst')->nullable();
            $table->string('consignee_mail')->nullable();
            $table->string('consignee_contact_person')->nullable();
            $table->string('consignee_contact_no')->nullable();
            $table->string('igst')->nullable();
            $table->string('sgst')->nullable();
            $table->string('cgst')->nullable();
            $table->string('total_fob_value')->nullable();
            $table->longText('amount_in_words')->nullable();
            $table->string('bank_name')->nullable();
            $table->longText('bank_address')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_ifsc_code')->nullable();
            $table->string('bank_ad_code')->nullable();
            $table->string('bank_swift_code')->nullable();
            $table->longText('payment_terms')->nullable();
            $table->dateTime('payment_delivery_time')->nullable();
            $table->longText('payment_delivery_terms')->nullable();
            $table->longText('notes')->nullable();
            $table->uuid('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pi_report_domestics');
    }
};
