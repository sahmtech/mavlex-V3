<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Zatca\Entities\ZatcaSetting; 

return new class extends Migration {
    public function up(): void
    {
        Schema::table('zatca_settings', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->after('business_id')->nullable();                   
            $table->foreign('location_id')->references('id')->on('business_locations')->onDelete('cascade');
            $table->unique(['business_id', 'location_id']);
        });
    }

    public function down(): void
    {
        // Schema::table('zatca_settings', function (Blueprint $table) {
        //     $table->dropUnique(['business_id', 'location_id']);
        //     $table->dropForeign(['location_id']);
        //     $table->dropColumn('location_id');
        // });
    }
};
