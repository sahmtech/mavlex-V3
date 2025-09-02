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
        Schema::table('business', function (Blueprint $table) {
            $table->foreign(['currency_id'])->references(['id'])->on('currencies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['default_sales_tax'])->references(['id'])->on('tax_rates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['owner_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business', function (Blueprint $table) {
            $table->dropForeign('business_currency_id_foreign');
            $table->dropForeign('business_default_sales_tax_foreign');
            $table->dropForeign('business_owner_id_foreign');
        });
    }
};
