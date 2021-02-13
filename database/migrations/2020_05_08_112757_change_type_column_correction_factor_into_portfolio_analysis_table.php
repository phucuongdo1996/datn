<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnCorrectionFactorIntoPortfolioAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio_analysis', function (Blueprint $table) {
            $table->decimal('correction_factor', 10, 1)->default(0.0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolio_analysis', function (Blueprint $table) {
            $table->integer('correction_factor')->nullable()->change();
        });
    }
}
