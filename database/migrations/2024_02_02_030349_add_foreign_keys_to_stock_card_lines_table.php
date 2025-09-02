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
        Schema::table('stock_card_lines', function (Blueprint $table) {
            $table->foreign(['product_id'], 'fk_product_id')->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['transaction_id'], 'fk_transaction_id')->references(['id'])->on('transactions')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['variation_id'], 'fk_variation_id')->references(['id'])->on('variations')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_card_lines', function (Blueprint $table) {
            $table->dropForeign('fk_product_id');
            $table->dropForeign('fk_transaction_id');
            $table->dropForeign('fk_variation_id');
        });
    }
};
