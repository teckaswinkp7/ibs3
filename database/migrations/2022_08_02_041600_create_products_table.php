<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('product_image');
            $table->string('short_description');
            $table->string('long_description');
            $table->string('additional_information');
            $table->string('sale_price');
            $table->string('regular_price');
            $table->timestamps();
            $table->integer('cat_id');
            $table->integer('subcat_id');
            $table->integer('is_featured');
            $table->integer('stock');
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
