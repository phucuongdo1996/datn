<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsBestsellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_bestseller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_base_id');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['product_base_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_bestseller');
    }
}
