<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('app_settings', function (Blueprint $t) {
            $t->boolean('enable_sidebar_dropdown')
              ->default(false)
              ->after('enable_custom_sidebar_logo');

            $t->string('sidebar_layout')
              ->default('layout1')
              ->after('enable_sidebar_dropdown');

            $t->string('custom_sidebar_type')
              ->default('sidebar')
              ->after('sidebar_layout');
              
            $t->string('business_settings_layout')
              ->default('layout1')
              ->after('custom_sidebar_type');
              
        });
    }

    public function down(): void
    {
        // Schema::table('app_settings', function (Blueprint $t) {
        //     $t->dropColumn([
        //         'enable_sidebar_dropdown',
        //         'sidebar_layout',
        //         'custom_sidebar_type',
        //     ]);
        // });
    }
};
