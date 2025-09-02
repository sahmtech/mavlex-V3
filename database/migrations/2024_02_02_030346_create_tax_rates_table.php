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
        Schema::create('tax_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('tax_rates_business_id_foreign');
            $table->string('name');
            $table->double('amount', 22, 4);
            $table->boolean('is_tax_group')->default(false);
            $table->boolean('for_tax_group')->default(false);
            $table->unsignedInteger('created_by')->index('tax_rates_created_by_foreign');
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
        Schema::dropIfExists('tax_rates');
    }
};
