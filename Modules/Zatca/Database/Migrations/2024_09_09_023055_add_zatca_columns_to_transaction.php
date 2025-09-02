<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddZatcaColumnsToTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('document_type',['simplified','standard'])->nullable();
            $table->string('invoice_type')->nullable()->default('388');
            $table->boolean('sent_to_zatca')->default(false);
            $table->index(['business_id', 'sent_to_zatca', 'type']);
        });
       
           
 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('transactions', function (Blueprint $table) {
        //     $table->enum('document_type',['simplified','standard'])->nullable();
        //     $table->string('invoice_type')->nullable()->default('388');
        //    $table->boolean('sent_to_zatca')->default(false);
        //    $table->boolean('is_phase_two')->default(false);
        // $table->index(['business_id', 'sent_to_zatca', 'type']);
        // });
    }
}
