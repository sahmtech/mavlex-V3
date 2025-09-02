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
        Schema::table('variation_value_templates', function (Blueprint $table) {
            $table->foreign(['variation_template_id'])->references(['id'])->on('variation_templates')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('variation_value_templates', function (Blueprint $table) {
            $table->dropForeign('variation_value_templates_variation_template_id_foreign');
        });
    }
};
