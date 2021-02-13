<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_formulas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('formula')->comment('1-賃料水準, 2-運営費用, 3-損害保険料, 4-修繕費, 5-維持管理費, 6-運営収益, 7-総合評価');
            $table->integer('real_estate_type_id');
            $table->string('region_acreage_year');
            $table->integer('amount');
            $table->integer('medium');
            $table->integer('first_quarter');
            $table->integer('average_number');
            $table->integer('third_quarter');
            $table->integer('standard_deviation');
            $table->integer('property_target');
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
        Schema::dropIfExists('index_formulas');
    }
}
