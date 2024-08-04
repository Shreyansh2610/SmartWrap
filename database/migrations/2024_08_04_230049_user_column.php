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
        $tables = ['banks','company_profiles','company_raw_materials','finish_goods','products','sizes'];
        foreach ($tables as $key => $dbTable) {
            Schema::table($dbTable, function (Blueprint $table) {
                $table->uuid('created_by')->nullable()->after('id');
            });

            // DB::table($dbTable)->update(['created_by'=>'1e194a12-0ed9-470d-b01e-0275840181a8']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['banks','company_profiles','company_raw_materials','finish_goods','products','sizes'];
        foreach ($tables as $key => $dbTable) {
            Schema::table($dbTable, function (Blueprint $table) {
                $table->dropColumn('created_by');
            });
        }
    }
};
