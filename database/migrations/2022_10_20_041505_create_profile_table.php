<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->integer('stu_id');
            $table->string('college_id');
            $table->string('cat_id');
            $table->string('home');
            $table->date('dob');
            $table->string('alternate_email');
            $table->string('alternet_phone');
            $table->string('secondary_school');
            $table->year('secondary_school_completed');
            $table->string('tertiary_education');
            $table->string('other_education');
            $table->string('current_location');
            $table->string('fathers_contact');
            $table->string('fathers_name');
            $table->string('fathers_email');
            $table->string('mothers_name');
            $table->string('mothers_email');
            $table->string('guardian_name');
            $table->string('mothers_contact');
            $table->string('guardian_contact');
            $table->string('guardian_email');
            $table->string('current_employment');
            $table->string('work_address');            
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
        Schema::dropIfExists('profile');
    }
}
