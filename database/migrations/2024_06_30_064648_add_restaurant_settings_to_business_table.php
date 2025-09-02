<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestaurantSettingsToBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business', function (Blueprint $table) {
            $table->text('restaurant_settings')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->after('dashboard_settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('business', function (Blueprint $table) {
        //     $table->dropColumn('restaurant_settings');
        // });
    }
}
