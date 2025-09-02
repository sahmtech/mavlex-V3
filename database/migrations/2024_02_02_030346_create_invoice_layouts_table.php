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
        Schema::create('invoice_layouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('header_text')->nullable();
            $table->string('invoice_no_prefix')->nullable();
            $table->string('quotation_no_prefix')->nullable();
            $table->string('invoice_heading')->nullable();
            $table->string('sub_heading_line1')->nullable();
            $table->string('sub_heading_line2')->nullable();
            $table->string('sub_heading_line3')->nullable();
            $table->string('sub_heading_line4')->nullable();
            $table->string('sub_heading_line5')->nullable();
            $table->string('invoice_heading_not_paid')->nullable();
            $table->string('invoice_heading_paid')->nullable();
            $table->string('quotation_heading')->nullable();
            $table->string('sub_total_label')->nullable();
            $table->string('discount_label')->nullable();
            $table->string('tax_label')->nullable();
            $table->string('total_label')->nullable();
            $table->string('round_off_label')->nullable();
            $table->string('total_due_label')->nullable();
            $table->string('paid_label')->nullable();
            $table->boolean('show_client_id')->default(false);
            $table->string('client_id_label')->nullable();
            $table->string('client_tax_label')->nullable();
            $table->string('date_label')->nullable();
            $table->string('date_time_format')->nullable();
            $table->boolean('show_time')->default(true);
            $table->boolean('show_brand')->default(false);
            $table->boolean('show_sku')->default(true);
            $table->boolean('show_cat_code')->default(true);
            $table->boolean('show_expiry')->default(false);
            $table->boolean('show_lot')->default(false);
            $table->boolean('show_image')->default(false);
            $table->boolean('show_sale_description')->default(false);
            $table->string('sales_person_label')->nullable();
            $table->boolean('show_sales_person')->default(false);
            $table->string('table_product_label')->nullable();
            $table->string('table_qty_label')->nullable();
            $table->string('table_unit_price_label')->nullable();
            $table->string('table_subtotal_label')->nullable();
            $table->string('cat_code_label')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('show_logo')->default(false);
            $table->boolean('show_business_name')->default(false);
            $table->boolean('show_location_name')->default(true);
            $table->boolean('show_landmark')->default(true);
            $table->boolean('show_city')->default(true);
            $table->boolean('show_state')->default(true);
            $table->boolean('show_zip_code')->default(true);
            $table->boolean('show_country')->default(true);
            $table->boolean('show_mobile_number')->default(true);
            $table->boolean('show_alternate_number')->default(false);
            $table->boolean('show_email')->default(false);
            $table->boolean('show_tax_1')->default(true);
            $table->boolean('show_tax_2')->default(false);
            $table->boolean('show_barcode')->default(false);
            $table->boolean('show_payments')->default(false);
            $table->boolean('show_customer')->default(false);
            $table->string('customer_label')->nullable();
            $table->string('commission_agent_label')->nullable();
            $table->boolean('show_commission_agent')->default(false);
            $table->boolean('show_reward_point')->default(false);
            $table->string('highlight_color', 10)->nullable();
            $table->text('footer_text')->nullable();
            $table->text('module_info')->nullable();
            $table->text('common_settings')->nullable();
            $table->boolean('is_default')->default(false);
            $table->unsignedInteger('business_id')->index('invoice_layouts_business_id_foreign');
            $table->boolean('show_letter_head')->default(false);
            $table->string('letter_head')->nullable();
            $table->boolean('show_qr_code')->default(false);
            $table->text('qr_code_fields')->nullable();
            $table->string('design', 190)->nullable()->default('classic');
            $table->string('cn_heading')->nullable()->comment('cn = credit note');
            $table->string('cn_no_label')->nullable();
            $table->string('cn_amount_label')->nullable();
            $table->text('table_tax_headings')->nullable();
            $table->boolean('show_previous_bal')->default(false);
            $table->string('prev_bal_label')->nullable();
            $table->string('change_return_label')->nullable();
            $table->text('product_custom_fields')->nullable();
            $table->text('contact_custom_fields')->nullable();
            $table->text('location_custom_fields')->nullable();
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
        Schema::dropIfExists('invoice_layouts');
    }
};
