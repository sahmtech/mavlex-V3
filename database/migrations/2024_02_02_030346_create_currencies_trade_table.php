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
        Schema::create('currencies_trade', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('local_currency', 11);
            $table->string('foreign_currency', 11);
            $table->integer('exchange_currency_id');
            $table->integer('local_currency_id');
            $table->integer('collection_availability');
            $table->integer('status')->default(1);
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies_trade');
    }
};
