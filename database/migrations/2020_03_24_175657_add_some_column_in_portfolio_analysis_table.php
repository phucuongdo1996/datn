<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnInPortfolioAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio_analysis', function (Blueprint $table) {
            $table->bigInteger('land_tax_assessment')->after('route_price')->default(0);
            $table->bigInteger('estimate_inheritance_tax_valuation')->after('land_tax_assessment')->default(0);
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
            $table->dropColumn('land_tax_assessment');
            $table->dropColumn('estimate_inheritance_tax_valuation');
        });
    }
}
