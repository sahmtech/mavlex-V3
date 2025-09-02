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
        Schema::create('res_product_modifier_sets', function (Blueprint $table) {
            $table->unsignedInteger('modifier_set_id')->index('res_product_modifier_sets_modifier_set_id_foreign');
            $table->unsignedInteger('product_id')->comment('Table use to store the modifier sets applicable for a product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_product_modifier_sets');
    }
};
