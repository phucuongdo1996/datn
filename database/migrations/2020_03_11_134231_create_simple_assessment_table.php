<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpleAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simple_assessments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->tinyInteger('status');
            $table->decimal('net_profit');
            $table->integer('amount_assessed_taxing');
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
        Schema::dropIfExists('simple_assessment');
    }
}
