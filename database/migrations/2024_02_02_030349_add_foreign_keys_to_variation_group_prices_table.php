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
        Schema::table('variation_group_prices', function (Blueprint $table) {
            $table->foreign(['price_group_id'])->references(['id'])->on('selling_price_groups')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['variation_id'])->references(['id'])->on('variations')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variation_group_prices', function (Blueprint $table) {
            $table->dropForeign('variation_group_prices_price_group_id_foreign');
            $table->dropForeign('variation_group_prices_variation_id_foreign');
        });
    }
};
