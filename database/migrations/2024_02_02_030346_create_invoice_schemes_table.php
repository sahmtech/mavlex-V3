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
        Schema::create('invoice_schemes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('invoice_schemes_business_id_foreign');
            $table->string('name');
            $table->enum('scheme_type', ['blank', 'year'])->index();
            $table->string('number_type', 100)->default('sequential')->index();
            $table->string('prefix')->nullable();
            $table->integer('start_number')->nullable();
            $table->integer('invoice_count')->default(0);
            $table->integer('total_digits')->nullable();
            $table->boolean('is_default')->default(false);
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
        Schema::dropIfExists('invoice_schemes');
    }
};
