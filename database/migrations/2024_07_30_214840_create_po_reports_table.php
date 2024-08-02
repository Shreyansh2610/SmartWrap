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
        Schema::create('po_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('po_no');
            $table->date('po_date')->nullable();
            $table->string('quotation_no')->nullable();
            $table->date('quotation_date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->longText('buyer_address')->nullable();
            $table->string('buyer_pan')->nullable();
            $table->string('buyer_iec')->nullable();
            $table->string('buyer_gst')->nullable();
            $table->string('buyer_mail')->nullable();
            $table->string('buyer_contact_person')->nullable();
            $table->string('buyer_contact_no')->nullable();
            $table->string('supplier_name')->nullable();
            $table->longText('supplier_address')->nullable();
            $table->string('supplier_pan')->nullable();
            $table->string('supplier_iec')->nullable();
            $table->string('supplier_gst')->nullable();
            $table->string('supplier_mail')->nullable();
            $table->string('supplier_contact_person')->nullable();
            $table->string('supplier_contact_no')->nullable();
            $table->uuid('created_by')->nullable();
            $table->string('igst')->nullable();
            $table->string('sgst')->nullable();
            $table->string('cgst')->nullable();
            $table->string('total_value')->nullable();
            $table->longText('amount_in_words')->nullable();
            $table->longText('notes_1')->nullable();
            $table->longText('notes_2')->nullable();
            $table->longText('notes_3')->nullable();
            $table->longText('notes_4')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_reports');
    }
};
