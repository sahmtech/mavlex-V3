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
        Schema::table('business_locations', function (Blueprint $table) {
            $table->foreign(['business_id'])->references(['id'])->on('business')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['invoice_layout_id'])->references(['id'])->on('invoice_layouts')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['invoice_scheme_id'])->references(['id'])->on('invoice_schemes')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_locations', function (Blueprint $table) {
            $table->dropForeign('business_locations_business_id_foreign');
            $table->dropForeign('business_locations_invoice_layout_id_foreign');
            $table->dropForeign('business_locations_invoice_scheme_id_foreign');
        });
    }
};
