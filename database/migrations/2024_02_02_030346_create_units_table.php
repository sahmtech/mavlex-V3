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
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('units_business_id_foreign');
            $table->string('actual_name');
            $table->string('short_name');
            $table->boolean('allow_decimal');
            $table->integer('base_unit_id')->nullable()->index();
            $table->decimal('base_unit_multiplier', 20, 4)->nullable();
            $table->unsignedInteger('created_by')->index('units_created_by_foreign');
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
        Schema::dropIfExists('units');
    }
};
