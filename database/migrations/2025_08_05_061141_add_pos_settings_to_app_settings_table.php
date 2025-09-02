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
        Schema::table('app_settings', function (Blueprint $table) {
            $table->boolean('enable_instant_pos')->default(false)->after('storage_default_disk');
            $table->boolean('enable_instant_search')->default(false)->after('enable_instant_pos');
            $table->string('pos_cache_refresh_interval', 20)->default('auto')->after('enable_instant_search');
            $table->integer('pos_max_cached_products')->default(1000)->after('pos_cache_refresh_interval')->comment('0 means unlimited');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            // $table->dropColumn([
            //     'enable_instant_pos',
            //     'enable_instant_search', 
            //     'pos_cache_refresh_interval',
            //     'pos_max_cached_products'
            // ]);
        });
    }
};
