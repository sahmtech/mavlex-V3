<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTax2LabelInBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('business', function (Blueprint $table) {
            $table->string('tax_label_2', 50)->change();
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
        //     $table->string('tax_2_label', 10)->change();
        // });
    }
}
