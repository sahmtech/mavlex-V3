<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('system', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key'); 
            $table->text('value')->nullable();
        });


        $version = config('author.app_version');

        // Seed the initial values
        DB::table('system')->insert([
            ['key' => 'db_version', 'value' => $version],
            ['key' => 'default_business_active_status', 'value' => '1'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system');
    }
}
