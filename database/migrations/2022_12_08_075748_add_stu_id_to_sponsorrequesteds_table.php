<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStuIdToSponsorrequestedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsorrequesteds', function (Blueprint $table) {
            $table->string('stu_id')->after('id');
            $table->string('sponsor_id')->after('stu_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsorrequesteds', function (Blueprint $table) {
            //
        });
    }
}
