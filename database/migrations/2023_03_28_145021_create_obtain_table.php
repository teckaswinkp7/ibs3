<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObtainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obtain', function (Blueprint $table) {
            $table->id();
            $table->string('stu_id');
            $table->string('language');
            $table->string('english');
            $table->string('maths');
            $table->string('economics');
            $table->string('accounting');
            $table->string('business');
            $table->string('geography');
            $table->string('history');
            $table->string('legal');
            $table->string('techno');
            $table->string('practical');
            $table->string('home');
            $table->string('personal');
            $table->string('biology');
            $table->string('chemistry');
            $table->string('physics');
            $table->string('appliedscience');
            $table->string('geology');
            $table->string('cgpa')->nullable();
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
        Schema::dropIfExists('obtain');
    }
}
