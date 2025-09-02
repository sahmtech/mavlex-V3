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
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('cash_registers_business_id_foreign');
            $table->integer('location_id')->nullable()->index();
            $table->unsignedInteger('user_id')->nullable()->index('cash_registers_user_id_foreign');
            $table->enum('status', ['close', 'open'])->default('open');
            $table->dateTime('closed_at')->nullable();
            $table->decimal('closing_amount', 22, 4)->default(0);
            $table->integer('total_card_slips')->default(0);
            $table->integer('total_cheques')->default(0);
            $table->text('denominations')->nullable();
            $table->text('closing_note')->nullable();
            $table->string('channel', 10)->default('Web');
            $table->string('unique_register_id', 255)->nullable()->unique('unique_register_id')->comment('unique_register_id_for_desktop');
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
        Schema::dropIfExists('cash_registers');
    }
};
