<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZatcaSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zatca_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('business_id');
            $table->string('zatca_env', 255)->default('simulation');
            $table->string('city')->nullable();
            $table->string('postal_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('building_number')->nullable();
            $table->string('plot_identification')->nullable();
            $table->string('city_sub_division')->nullable();
            $table->boolean('enable_auto_sync')->default(false);
            $table->string('sync_frequency')->nullable();
            $table->string('invoice_issue_type')->nullable();
            $table->string('company_address')->nullable();
            $table->string('businessCategory')->nullable();
            $table->boolean('is_phase_two')->nullable();
            $table->string('otp')->nullable();
            $table->string('invoicing_type')->nullable();
            $table->string('is_connected')->default('0');
            $table->longText('private_key')->nullable();
            $table->longText('public_key')->nullable();
            $table->longText('csr_request')->nullable();
            $table->longText('cnf')->nullable();
            $table->longText('cert_compliance')->nullable();
            $table->longText('secret_compliance')->nullable();
            $table->longText('csid_id_compliance')->nullable();
            $table->longText('cert_production')->nullable();
            $table->longText('secret_production')->nullable();
            $table->longText('csid_id_production')->nullable();

            $table->timestamps();
            $table->foreign(['business_id'])->references(['id'])->on('business')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->index('business_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zatca_settings');
    }
}
