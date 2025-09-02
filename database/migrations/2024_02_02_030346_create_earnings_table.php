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
        Schema::create('earnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id');
            $table->string('amount', 11);
            $table->string('type', 255);
            $table->string('approved_date', 255)->nullable();
            $table->string('status', 255);
            $table->string('transaction_type', 255);
            $table->integer('business_id');
            $table->string('percentage', 255)->nullable();
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
        Schema::dropIfExists('earnings');
    }
};
