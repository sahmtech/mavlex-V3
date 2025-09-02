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
        Schema::create('transaction_sell_lines_purchase_lines_v2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sell_line_id')->nullable()->index('sell_line_id')->comment('id from transaction_sell_lines');
            $table->unsignedInteger('stock_adjustment_line_id')->nullable()->index('stock_adjustment_line_id')->comment('id from stock_adjustment_lines');
            $table->unsignedInteger('purchase_line_id')->index('purchase_line_id')->comment('id from purchase_lines');
            $table->decimal('quantity', 20, 4);
            $table->decimal('qty_returned', 20, 4)->default(0);
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
        Schema::dropIfExists('transaction_sell_lines_purchase_lines_v2');
    }
};
