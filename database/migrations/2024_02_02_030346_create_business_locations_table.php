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
        Schema::create('business_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index();
            $table->string('location_id')->nullable();
            $table->string('name', 256);
            $table->text('landmark')->nullable();
            $table->string('country', 100);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->char('zip_code', 7);
            $table->unsignedInteger('invoice_scheme_id')->index('business_locations_invoice_scheme_id_foreign');
            $table->integer('sale_invoice_scheme_id')->nullable();
            $table->unsignedInteger('invoice_layout_id')->index('business_locations_invoice_layout_id_foreign');
            $table->integer('sale_invoice_layout_id')->nullable()->index();
            $table->integer('selling_price_group_id')->nullable()->index();
            $table->boolean('print_receipt_on_invoice')->nullable()->default(true);
            $table->enum('receipt_printer_type', ['browser', 'printer'])->default('browser')->index();
            $table->integer('printer_id')->nullable()->index();
            $table->string('mobile')->nullable();
            $table->string('alternate_number')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('featured_products')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('default_payment_accounts')->nullable();
            $table->string('custom_field1')->nullable();
            $table->string('custom_field2')->nullable();
            $table->string('custom_field3')->nullable();
            $table->string('custom_field4')->nullable();
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
        Schema::dropIfExists('business_locations');
    }
};
