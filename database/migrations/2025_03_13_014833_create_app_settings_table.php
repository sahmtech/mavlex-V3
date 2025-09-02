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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->json('two_factor_settings')->nullable();
            $table->json('maintenance_mode')->nullable();
            $table->boolean('enable_theme_change')->default(false);
            $table->json('theme_settings')->nullable();
            $table->boolean('login_bg_image')->default(false);
            $table->string('login_bg_image_url')->nullable();
            $table->boolean('enable_custom_sidebar_logo')->default(false);
            $table->boolean('header_language_change')->default(false);
            $table->string('header_languages')->nullable();
            $table->json('app_logo')->nullable();
            $table->json('fonts')->nullable();
            $table->json('google_recaptcha')->nullable();
            $table->json('social_logins')->nullable();
            $table->json('user_lock')->nullable();
            $table->boolean('force_email_verify')->default(false);
            $table->boolean('temp_email_protection')->default(false);
            $table->boolean('show_repair_status_login_screen')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      //  Schema::dropIfExists('app_settings');
    }
};
