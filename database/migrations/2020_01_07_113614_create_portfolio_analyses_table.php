<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_analysis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('property_id');
            $table->bigInteger('route_price')->nullable();
            $table->string('land_evaluation_note')->nullable();
            $table->bigInteger('tax_valuation')->nullable();
            $table->string('building_selection')->nullable();
            $table->integer('correction_factor')->nullable();
            $table->bigInteger('noi')->nullable();
            $table->integer('noi_yield')->nullable();
            $table->bigInteger('tax_land_price')->nullable();
            $table->bigInteger('inheritance_tax_valuation')->nullable();
            $table->bigInteger('debt_balance')->nullable();
            $table->bigInteger('inheritance_tax_debt_balance')->nullable();
            $table->bigInteger('assessed_amount')->nullable();
            $table->bigInteger('assessed_amount_debt_balance')->nullable();
            $table->bigInteger('comprehensive_balance_evaluation')->nullable();
            $table->integer('acquisition_price_yield')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('portfolio_analyses');
    }
}
