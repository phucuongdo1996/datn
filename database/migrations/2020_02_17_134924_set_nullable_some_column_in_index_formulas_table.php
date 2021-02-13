<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullableSomeColumnInIndexFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('index_formulas', function (Blueprint $table) {
            $table->integer('amount')->nullable()->change();
            $table->integer('medium')->nullable()->change();
            $table->integer('first_quarter')->nullable()->change();
            $table->integer('average_number')->nullable()->change();
            $table->integer('third_quarter')->nullable()->change();
            $table->integer('standard_deviation')->nullable()->change();
            $table->integer('property_target')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('index_formulas', function (Blueprint $table) {
            $table->integer('amount')->nullable(false)->change();
            $table->integer('medium')->nullable(false)->change();
            $table->integer('first_quarter')->nullable(false)->change();
            $table->integer('average_number')->nullable(false)->change();
            $table->integer('third_quarter')->nullable(false)->change();
            $table->integer('standard_deviation')->nullable(false)->change();
            $table->integer('property_target')->nullable(false)->change();
        });
    }
}
