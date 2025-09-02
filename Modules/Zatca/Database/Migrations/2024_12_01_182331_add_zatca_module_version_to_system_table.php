<?php

use Illuminate\Database\Migrations\Migration;

class AddZatcaModuleVersionToSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('system')->insert([
            'key' => 'zatca_version',
            'value' => config('zatca.module_version', 0.1),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
