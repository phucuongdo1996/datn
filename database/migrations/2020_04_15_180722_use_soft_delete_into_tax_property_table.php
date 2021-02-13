<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UseSoftDeleteIntoTaxPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tax_property', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('simple_assessments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('profile_qualification', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('profile_specialty', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tax_property', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('simple_assessments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('profile_qualification', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('profile_specialty', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
