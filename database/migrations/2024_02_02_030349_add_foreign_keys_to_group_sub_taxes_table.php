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
        Schema::table('group_sub_taxes', function (Blueprint $table) {
            $table->foreign(['group_tax_id'])->references(['id'])->on('tax_rates')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['tax_id'])->references(['id'])->on('tax_rates')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_sub_taxes', function (Blueprint $table) {
            $table->dropForeign('group_sub_taxes_group_tax_id_foreign');
            $table->dropForeign('group_sub_taxes_tax_id_foreign');
        });
    }
};
