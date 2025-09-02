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
        Schema::create('business_type', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('business_id', 255);
            $table->string('business_type', 255);
            $table->integer('sms_verification')->nullable();
            $table->integer('kyc_verification')->default(0);
            $table->integer('bo_payout')->default(0);
            $table->string('wall_id', 255)->nullable();
            $table->string('user_id', 225)->nullable();
            $table->string('status', 255)->default('uncompleted');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_type');
    }
};
