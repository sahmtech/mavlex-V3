<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnColumnsToInvoiceLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_layouts', function (Blueprint $table) {
            $table->string('invoice_heading_en')->after('invoice_heading')->nullable();
            $table->string('invoice_heading_not_paid_en')->after('invoice_heading_not_paid')->nullable();
            $table->string('invoice_heading_paid_en')->after('invoice_heading_paid')->nullable();
            $table->string('quotation_heading_en')->after('quotation_heading')->nullable();
            $table->string('invoice_no_prefix_en')->after('invoice_no_prefix')->nullable();
            $table->string('quotation_no_prefix_en')->after('quotation_no_prefix')->nullable();
            $table->string('date_label_en')->after('date_label')->nullable();
            $table->string('sales_person_label_en')->after('sales_person_label')->nullable();
            $table->string('commission_agent_label_en')->after('commission_agent_label')->nullable();
            $table->string('customer_label_en')->after('customer_label')->nullable();
            $table->string('client_id_label_en')->after('client_id_label')->nullable();
            $table->string('client_tax_label_en')->after('client_tax_label')->nullable();
            $table->string('table_product_label_en')->after('table_product_label')->nullable();
            $table->string('table_qty_label_en')->after('table_qty_label')->nullable();
            $table->string('table_unit_price_label_en')->after('table_unit_price_label')->nullable();
            $table->string('table_subtotal_label_en')->after('table_subtotal_label')->nullable();
            $table->string('cat_code_label_en')->after('cat_code_label')->nullable();
            $table->string('sub_total_label_en')->after('sub_total_label')->nullable();
            $table->string('discount_label_en')->after('discount_label')->nullable();
            $table->string('tax_label_en')->after('tax_label')->nullable();
            $table->string('total_label_en')->after('total_label')->nullable();
            $table->string('round_off_label_en')->after('round_off_label')->nullable();
            $table->string('paid_label_en')->after('paid_label')->nullable();
            $table->string('total_due_label_en')->after('total_due_label')->nullable();
            $table->string('prev_bal_label_en')->after('prev_bal_label')->nullable();
            $table->string('change_return_label_en')->after('change_return_label')->nullable();
            $table->string('cn_heading_en')->after('cn_heading')->nullable();
            $table->string('cn_no_label_en')->after('cn_no_label')->nullable();
            $table->string('cn_amount_label_en')->after('cn_amount_label')->nullable();
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_layouts', function (Blueprint $table) {
            //
        });
    }
}
