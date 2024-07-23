<?php

use App\Models\CompanyProfile;
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

        Schema::create('company_profiles', function (Blueprint $table) {
            // edit profile
            $table->uuid('id')->primary();
            $table->string('company_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('otp_mobile_phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('website')->nullable();
            $table->string('company_register')->nullable();
            $table->longText('address')->nullable();
            $table->longText('portal_address')->nullable();
            $table->longText('company_type')->nullable();
            // company reg. detail
            $table->string('gst_no')->nullable();
            $table->string('lut_no')->nullable();
            $table->string('cin')->nullable();
            $table->string('gst_circular_no')->nullable();
            $table->string('state_code')->nullable();
            $table->string('lei_no')->nullable();
            $table->string('field_3')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('lut_expiry')->nullable();
            $table->string('rcmc_no')->nullable();
            $table->string('date_of_filling_rex_number')->nullable();
            $table->string('field_1')->nullable();
            $table->string('field_4')->nullable();
            $table->string('iec_no')->nullable();
            $table->string('bin_no')->nullable();
            $table->string('rcmc_expiry')->nullable();
            $table->string('circular_no')->nullable();
            $table->string('aeo_no')->nullable();
            $table->string('field_2')->nullable();
            $table->string('field_5')->nullable();
            // company_settings
            $table->string('pre_carriage_by')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('delivery_period')->nullable();
            $table->string('terms_of_delivery')->nullable();
            $table->string('place_of_receipt')->nullable();
            $table->string('part_of_loading')->nullable();
            $table->string('partial_shipement')->nullable();
            $table->string('district_of_origin')->nullable();
            $table->string('trans_shipement')->nullable();
            $table->string('variety_of_quality')->nullable();
            $table->longText('company_logo')->nullable();
            $table->longText('signature_upload')->nullable();
            // annexure detail
            $table->string('range')->nullable();
            $table->string('division')->nullable();
            $table->string('commissionerate')->nullable();
            $table->string('location_code')->nullable();
            $table->string('annexure_remark')->nullable();
            // vgm detail
            $table->string('shipper_name')->nullable();
            $table->string('method_used_for_vgm')->nullable();
            $table->string('weighbridge_slip_no')->nullable();
            $table->string('name_and_designation_of_office')->nullable();
            $table->string('weighbridge_registration_no')->nullable();
            $table->longText('shipper_address')->nullable();
            $table->string('vgm_remarks')->nullable();
            // bank detail
            $table->uuid('bank_id')->nullable();
            // export details
            $table->longText('export_under_detail_1')->nullable();
            $table->longText('export_under_detail_2')->nullable();
            $table->longText('export_remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        CompanyProfile::create([]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
