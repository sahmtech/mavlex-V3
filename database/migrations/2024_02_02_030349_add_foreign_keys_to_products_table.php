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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['brand_id'])->references(['id'])->on('brands')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['business_id'])->references(['id'])->on('business')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['sub_category_id'])->references(['id'])->on('categories')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['tax'])->references(['id'])->on('tax_rates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['unit_id'])->references(['id'])->on('units')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_brand_id_foreign');
            $table->dropForeign('products_business_id_foreign');
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_created_by_foreign');
            $table->dropForeign('products_sub_category_id_foreign');
            $table->dropForeign('products_tax_foreign');
            $table->dropForeign('products_unit_id_foreign');
        });
    }
};
