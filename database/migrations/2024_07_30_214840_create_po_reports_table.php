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
            $table->date('po_date');
            $table->string('quotation_no');
            $table->date('quotation_date');
            $table->string('buyer_name');
            $table->longText('buyer_address');
            $table->string('buyer_pan');
            $table->string('buyer_iec');
            $table->string('buyer_gst');
            $table->string('buyer_mail');
            $table->string('buyer_contact_person');
            $table->string('buyer_contact_no');
            $table->uuid('created_by');
            $table->string('igst');
            $table->string('sgst');
            $table->string('cgst');
            $table->string('total_value');
            $table->longText('amount_in_words');
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
