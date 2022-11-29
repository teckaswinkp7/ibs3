<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            
            $table->string('title')->after('course_id')->nullable();
            $table->string('middle_name')->after('sponsor_name')->nullable();
            $table->string('last_name')->after('middle_name')->nullable();
            $table->string('position')->after('last_name')->nullable();
            $table->string('alt_email')->after('sponsor_email')->nullable();
            $table->integer('alt_phone')->after('sponsor_phone')->nullable();
            $table->string('company_name')->after('sponsor_phone')->nullable();
            $table->string('province')->after('sponsor_phone')->nullable();
            $table->string('address')->after('province')->nullable();
            $table->integer('main_phone_line')->after('address')->nullable();
            $table->integer('alt_phone_line')->after('main_phone_line')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            //
        });
    }
}
