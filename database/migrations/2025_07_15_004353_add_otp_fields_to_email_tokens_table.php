<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_tokens', function (Blueprint $table) {
            $table->unsignedTinyInteger('resend_count')->default(0)->after('token');
            $table->timestamp('last_resend_at')->nullable()->after('resend_count');
            $table->string('otp', 6)->nullable()->after('token');
            $table->timestamp('otp_expires_at')->nullable()->after('otp');
            $table->integer('otp_attempts')->default(0)->after('otp_expires_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_tokens', function (Blueprint $table) {
           // $table->dropColumn(['otp', 'otp_expires_at', 'otp_attempts']);
        });
    }
};