<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->decimal('ground_area', 20 , 2)->nullable()->change();
            $table->decimal('total_area_floors', 20 , 2)->nullable()->change();
            $table->decimal('area_rental_operating', 20 , 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->integer('ground_area')->nullable()->change();
            $table->integer('total_area_floors')->nullable()->change();
            $table->bigInteger('area_rental_operating')->nullable()->change();
        });
    }
}
