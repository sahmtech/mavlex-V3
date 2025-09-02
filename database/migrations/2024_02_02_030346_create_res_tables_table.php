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
        Schema::create('res_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('res_tables_business_id_foreign');
            $table->unsignedInteger('location_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_tables');
    }
};
