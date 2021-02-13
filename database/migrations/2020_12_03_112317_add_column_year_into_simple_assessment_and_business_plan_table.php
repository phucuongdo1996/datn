<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnYearIntoSimpleAssessmentAndBusinessPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simple_assessments', function (Blueprint $table) {
            $table->integer('year')->after('property_id')->nullable();
        });
        Schema::table('business_plans', function (Blueprint $table) {
            $table->integer('year')->after('property_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simple_assessments', function (Blueprint $table) {
            $table->dropColumn('year');
        });
        Schema::table('business_plans', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
}
