<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeOfColumnInSimpleAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simple_assessments', function (Blueprint $table) {
            $table->decimal('net_profit', 20, 2)->change();
            $table->bigInteger('amount_assessed_taxing')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simple_assessment', function (Blueprint $table) {
            $table->decimal('net_profit')->change();
            $table->integer('amount_assessed_taxing')->change();
        });
    }
}
