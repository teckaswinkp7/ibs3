<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountPaidToPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment', function (Blueprint $table) {
            $table->integer('amount_paid')->after('amountdue')->nullable();
            $table->integer('balance_due')->after('amount_paid')->nullable();
            $table->string('ibs_reciept')->after('payreciept')->nullable();
            $table->date('issue_date')->after('ibs_reciept')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            
        });
    }
}
