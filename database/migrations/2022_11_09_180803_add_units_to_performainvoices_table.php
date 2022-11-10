<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitsToPerformainvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performainvoices', function (Blueprint $table) {
            $table->longtext('units')->after('additional_item')->nullable();
            $table->integer('invoiceno')->after('units')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performainvoices', function (Blueprint $table) {
            //
        });
    }
}
