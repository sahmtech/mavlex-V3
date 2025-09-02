<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComboModifierIdsToTransactionSellLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_sell_lines', function (Blueprint $table) {
            $table->string('combo_modifier_ids', 255)
                  ->nullable()
                  ->after('children_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('transaction_sell_lines', function (Blueprint $table) {
        //     $table->dropColumn('combo_modifier_ids');
        // });
    }
}
