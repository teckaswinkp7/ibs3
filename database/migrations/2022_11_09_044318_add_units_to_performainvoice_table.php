<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitsToPerformainvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performainvoices', function (Blueprint $table) {
            
            $table->longtext('units')->nullable();
            $table->integer('invoiceno')->nullable();
            $table->string('sem')->nullable();
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
            
            Schema::dropIfExists('performainvoices');
        });
    }
}
