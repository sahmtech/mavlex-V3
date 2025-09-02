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
        Schema::table('cash_register_transactions', function (Blueprint $table) {
            $table->foreign(['cash_register_id'])->references(['id'])->on('cash_registers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cash_register_transactions', function (Blueprint $table) {
            $table->dropForeign('cash_register_transactions_cash_register_id_foreign');
        });
    }
};
