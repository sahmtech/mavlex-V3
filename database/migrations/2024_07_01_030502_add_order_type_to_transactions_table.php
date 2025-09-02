<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderTypeToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('order_type', ['dine_in', 'takeaway', 'delivery'])
                  ->nullable()
                  ->default(null)
                  ->after('is_running_order');
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
        //     $table->dropColumn('order_type');
        // });
    }
}
