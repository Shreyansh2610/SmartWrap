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
        Schema::create('pi_report_exports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pi_no');
            $table->date('date')->nullable();
            $table->string('buyer_order_no')->nullable();
            $table->date('buyer_order_date')->nullable();
            $table->string('exporter_name')->nullable();
            $table->longText('exporter_address')->nullable();
            $table->string('exporter_pan')->nullable();
            $table->string('exporter_iec')->nullable();
            $table->string('exporter_gst')->nullable();
            $table->string('exporter_mail')->nullable();
            $table->string('exporter_contact_person')->nullable();
            $table->string('exporter_contact_no')->nullable();
            $table->string('consignee_name')->nullable();
            $table->longText('consignee_address')->nullable();
            $table->string('consignee_country')->nullable();
            $table->string('consignee_mail')->nullable();
            $table->string('consignee_contact_person')->nullable();
            $table->string('consignee_contact_no')->nullable();
            $table->string('port_of_loading')->nullable();
            $table->string('port_of_discharge')->nullable();
            $table->string('final_destination_port')->nullable();
            $table->string('country_of_origin_of_goods')->nullable();
            $table->string('country_of_final_destination')->nullable();
            $table->string('total_fob_value')->nullable();
            $table->string('freight_charges')->nullable();
            $table->string('total_cfr_value')->nullable();
            $table->string('insurance_charges')->nullable();
            $table->string('total_cif_value')->nullable();
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
        Schema::dropIfExists('pi_report_exports');
    }
};
