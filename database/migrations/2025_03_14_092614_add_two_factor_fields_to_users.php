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
        Schema::table('users', function (Blueprint $table) {
            $table->text('google2fa_secret')->nullable();
            $table->boolean('two_factor_enabled')->default(false);
            $table->timestamp('disable_2fa_until')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->string('provider')->nullable()->after('password');
            $table->string('provider_id')->nullable()->after('provider');
            $table->integer('failed_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn('two_factor_enabled');
        //     $table->dropColumn('disable_2fa_until');
        // });
    }
};
