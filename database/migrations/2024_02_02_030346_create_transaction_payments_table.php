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
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transaction_id')->nullable()->index('transaction_payments_transaction_id_foreign');
            $table->integer('business_id')->nullable();
            $table->boolean('is_return')->default(false)->comment('Used during sales to return the change');
            $table->decimal('amount', 22, 4)->default(0);
            $table->string('method')->nullable();
            $table->string('payment_type')->nullable()->index();
            $table->string('transaction_no')->nullable();
            $table->string('card_transaction_number')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_month')->nullable();
            $table->string('card_year')->nullable();
            $table->string('card_security', 5)->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->dateTime('paid_on')->nullable();
            $table->integer('created_by')->nullable()->index();
            $table->boolean('paid_through_link')->default(false);
            $table->string('gateway')->nullable();
            $table->boolean('is_advance')->default(false);
            $table->integer('payment_for')->nullable()->comment('stores the contact id');
            $table->integer('parent_id')->nullable()->index();
            $table->string('note')->nullable();
            $table->string('document')->nullable();
            $table->string('payment_ref_no')->nullable();
            $table->integer('account_id')->nullable();
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
        Schema::dropIfExists('transaction_payments');
    }
};
