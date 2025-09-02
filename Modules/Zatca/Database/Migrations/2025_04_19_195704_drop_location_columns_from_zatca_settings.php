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
        Schema::table('zatca_settings', function (Blueprint $table) {
            $table->dropColumn([
                'city',
                'postal_number',
                'street_name',
                'building_number',
                'plot_identification',
                'city_sub_division',
                'enable_auto_sync',
                'sync_frequency',
                'invoice_issue_type',
                'company_address',
                'businessCategory',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zatca_settings', function (Blueprint $table) {
            //
        });
    }
};
