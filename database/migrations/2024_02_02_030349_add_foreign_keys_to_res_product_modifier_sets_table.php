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
        Schema::table('res_product_modifier_sets', function (Blueprint $table) {
            $table->foreign(['modifier_set_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('res_product_modifier_sets', function (Blueprint $table) {
            $table->dropForeign('res_product_modifier_sets_modifier_set_id_foreign');
        });
    }
};
