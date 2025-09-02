<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::table('business')
            ->whereNotNull('theme_color')
            ->update(['theme_color' => "{}"]);

        Schema::table('business', function (Blueprint $table) {
            $table->json('theme_color')->nullable()->change();
        });
    }

public function down()
{
    // Schema::table('business', function (Blueprint $table) {
    //      Revert back to the original type if needed
    //      $table->char('theme_color', 20)->nullable()->change();
    // });
}

};
