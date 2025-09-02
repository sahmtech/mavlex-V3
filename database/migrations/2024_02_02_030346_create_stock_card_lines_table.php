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
        Schema::create('stock_card_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transaction_id')->index();
            $table->unsignedInteger('product_id')->index('stock_card_lines_product_id_foreign');
            $table->unsignedInteger('variation_id')->index('stock_card_lines_variation_id_foreign');
            $table->integer('quantity_in')->nullable()->default(0);
            $table->integer('quantity_out')->nullable()->default(0);
            $table->decimal('unit_price', 22, 4)->nullable();
            $table->integer('removed_purchase_line')->nullable();
            $table->integer('lot_no_line_id')->nullable()->index();
            $table->string('description')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('mfd_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('remark')->nullable();
            $table->dateTime('transaction_date');
            $table->unsignedInteger('created_by')->nullable();
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
        Schema::dropIfExists('stock_card_lines');
    }
};
