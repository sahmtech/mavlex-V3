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
        Schema::create('business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('currency_id')->index('business_currency_id_foreign');
            $table->date('start_date')->nullable();
            $table->string('tax_number_1', 100)->nullable();
            $table->string('tax_label_1', 10)->nullable();
            $table->string('tax_number_2', 100)->nullable();
            $table->string('tax_label_2', 10)->nullable();
            $table->string('code_label_1')->nullable();
            $table->string('code_1')->nullable();
            $table->string('code_label_2')->nullable();
            $table->string('code_2')->nullable();
            $table->unsignedInteger('default_sales_tax')->nullable()->index('business_default_sales_tax_foreign');
            $table->double('default_profit_percent', 5, 2)->default(0);
            $table->unsignedInteger('owner_id')->index('business_owner_id_foreign');
            $table->string('time_zone')->default('Asia/Kolkata');
            $table->tinyInteger('fy_start_month')->default(1);
            $table->enum('accounting_method', ['fifo', 'lifo', 'avco'])->default('fifo');
            $table->decimal('default_sales_discount', 5)->nullable();
            $table->enum('sell_price_tax', ['includes', 'excludes'])->default('includes');
            $table->string('logo')->nullable();
            $table->string('sku_prefix')->nullable();
            $table->boolean('enable_product_expiry')->default(false);
            $table->enum('expiry_type', ['add_expiry', 'add_manufacturing'])->default('add_expiry');
            $table->enum('on_product_expiry', ['keep_selling', 'stop_selling', 'auto_delete'])->default('keep_selling');
            $table->integer('stop_selling_before')->comment('Stop selling expied item n days before expiry');
            $table->boolean('enable_tooltip')->default(true);
            $table->boolean('purchase_in_diff_currency')->default(false)->comment('Allow purchase to be in different currency then the business currency');
            $table->unsignedInteger('purchase_currency_id')->nullable();
            $table->decimal('p_exchange_rate', 20, 3)->default(1);
            $table->unsignedInteger('transaction_edit_days')->default(30);
            $table->unsignedInteger('stock_expiry_alert_days')->default(30);
            $table->text('keyboard_shortcuts')->nullable();
            $table->text('pos_settings')->nullable();
            $table->text('invoice_settings')->nullable();
            $table->text('weighing_scale_setting')->comment('used to store the configuration of weighing scale');
            $table->boolean('enable_brand')->default(true);
            $table->boolean('enable_category')->default(true);
            $table->boolean('enable_sub_category')->default(true);
            $table->boolean('enable_price_tax')->default(true);
            $table->boolean('enable_purchase_status')->nullable()->default(true);
            $table->boolean('enable_lot_number')->default(false);
            $table->integer('default_unit')->nullable();
            $table->boolean('enable_sub_units')->default(false);
            $table->boolean('enable_racks')->default(false);
            $table->boolean('enable_row')->default(false);
            $table->boolean('enable_position')->default(false);
            $table->boolean('enable_editing_product_from_purchase')->default(true);
            $table->enum('sales_cmsn_agnt', ['logged_in_user', 'user', 'cmsn_agnt'])->nullable();
            $table->boolean('item_addition_method')->default(true);
            $table->boolean('enable_inline_tax')->default(true);
            $table->enum('currency_symbol_placement', ['before', 'after'])->default('before');
            $table->text('enabled_modules')->nullable();
            $table->string('date_format')->default('m/d/Y');
            $table->enum('time_format', ['12', '24'])->default('24');
            $table->tinyInteger('currency_precision')->default(2);
            $table->tinyInteger('quantity_precision')->default(2);
            $table->text('ref_no_prefixes')->nullable();
            $table->char('theme_color', 20)->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('enable_rp')->default(false)->comment('rp is the short form of reward points');
            $table->string('rp_name')->nullable()->comment('rp is the short form of reward points');
            $table->decimal('amount_for_unit_rp', 22, 4)->default(1)->comment('rp is the short form of reward points');
            $table->decimal('min_order_total_for_rp', 22, 4)->default(1)->comment('rp is the short form of reward points');
            $table->integer('max_rp_per_order')->nullable()->comment('rp is the short form of reward points');
            $table->decimal('redeem_amount_per_unit_rp', 22, 4)->default(1)->comment('rp is the short form of reward points');
            $table->decimal('min_order_total_for_redeem', 22, 4)->default(1)->comment('rp is the short form of reward points');
            $table->integer('min_redeem_point')->nullable()->comment('rp is the short form of reward points');
            $table->integer('max_redeem_point')->nullable()->comment('rp is the short form of reward points');
            $table->integer('rp_expiry_period')->nullable()->comment('rp is the short form of reward points');
            $table->enum('rp_expiry_type', ['month', 'year'])->default('year')->comment('rp is the short form of reward points');
            $table->text('email_settings')->nullable();
            $table->text('sms_settings')->nullable();
            $table->text('custom_labels')->nullable();
            $table->text('common_settings')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('ep_unit_cost_before_discount')->nullable()->default(true);
            $table->boolean('ep_unit_cost_price_before_tax')->nullable()->default(true);
            $table->boolean('ep_sub_total_before_tax')->nullable()->default(true);
            $table->boolean('ep_unit_cost_price_after_tax')->nullable()->default(true);
            $table->boolean('ep_unit_selling_price')->nullable()->default(true);
            $table->boolean('ep_sub_total')->nullable()->default(true);
            $table->boolean('ep_payment_info')->nullable()->default(true);
            $table->boolean('ep_net_total_amount')->nullable()->default(true);
            $table->boolean('ep_discount')->nullable()->default(true);
            $table->boolean('ep_purchase_tax')->nullable()->default(true);
            $table->boolean('ep_additional_shipping_charges')->nullable()->default(true);
            $table->boolean('ep_purchase_total')->nullable()->default(true);
            $table->boolean('ep_shipping_details')->nullable()->default(true);
            $table->boolean('es_unit_price')->nullable()->default(true);
            $table->boolean('es_sub_total')->nullable()->default(true);
            $table->boolean('es_net_total_amount')->nullable()->default(true);
            $table->boolean('es_additional_shipping_charges')->nullable()->default(true);
            $table->boolean('es_purchase_total')->nullable()->default(true);
            $table->boolean('es_approved_by')->nullable()->default(false);
            $table->tinyInteger('ep_reference')->nullable()->default(0);
            $table->tinyInteger('ep_pay_term')->nullable()->default(0);
            $table->tinyInteger('ep_additional_expenses')->nullable()->default(0);
            $table->tinyInteger('enable_product_image')->nullable()->default(0);
            $table->tinyInteger('enable_product_description')->nullable()->default(0);
            $table->string('product_barcode_type')->nullable();
            $table->tinyInteger('enable_selected_contacts')->default(0);
            $table->tinyInteger('accept_kyc_terms_of_service')->nullable()->default(0);
            $table->string('business_type', 255)->nullable();
            $table->integer('bo_payout')->nullable()->default(0);
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
        Schema::dropIfExists('business');
    }
};
