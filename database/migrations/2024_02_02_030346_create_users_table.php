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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_type')->default('user')->index();
            $table->char('surname', 10)->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->char('language', 7)->default('en');
            $table->char('contact_no', 15)->nullable();
            $table->text('address')->nullable();
            $table->rememberToken();
            $table->unsignedInteger('business_id')->nullable()->index('users_business_id_foreign');
            $table->dateTime('available_at')->nullable()->comment('Service staff avilable at. Calculated from product preparation_time_in_minutes');
            $table->dateTime('paused_at')->nullable()->comment('Service staff available time paused at, Will be nulled on resume.');
            $table->decimal('max_sales_discount_percent', 5)->nullable();
            $table->boolean('allow_login')->default(true);
            $table->enum('status', ['active', 'inactive', 'terminated'])->default('active');
            $table->boolean('is_enable_service_staff_pin')->default(false);
            $table->text('service_staff_pin')->nullable();
            $table->unsignedInteger('crm_contact_id')->nullable()->index('users_crm_contact_id_foreign');
            $table->boolean('is_cmmsn_agnt')->default(false);
            $table->decimal('cmmsn_percent', 4)->default(0);
            $table->boolean('selected_contacts')->default(false);
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->enum('marital_status', ['married', 'unmarried', 'divorced'])->nullable();
            $table->char('blood_group', 10)->nullable();
            $table->char('contact_number', 20)->nullable();
            $table->string('alt_number')->nullable();
            $table->string('family_number')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('social_media_1')->nullable();
            $table->string('social_media_2')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('current_address')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('custom_field_1')->nullable();
            $table->string('custom_field_2')->nullable();
            $table->string('custom_field_3')->nullable();
            $table->string('custom_field_4')->nullable();
            $table->longText('bank_details')->nullable();
            $table->string('id_proof_name')->nullable();
            $table->string('id_proof_number')->nullable();
            $table->string('partner_id', 255)->nullable();
            $table->integer('agent_lead')->nullable();
            $table->string('rating', 255)->default('0');
            $table->string('agent_referal_code', 255)->nullable();
            $table->integer('sms_verification')->nullable();
            $table->integer('registration_package_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
