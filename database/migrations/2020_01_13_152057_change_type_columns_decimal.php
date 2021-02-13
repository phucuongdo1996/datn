<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnsDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio_analysis', function (Blueprint $table) {
            $table->dropColumn('noi')->nullable();
            $table->decimal('noi_yield', 10 , 2)->nullable()->change();
            $table->dropColumn('debt_balance')->nullable();
            $table->decimal('acquisition_price_yield', 10, 2)->nullable()->change();
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
            $table->bigInteger('noi')->nullable();
            $table->integer('noi_yield')->nullable()->change();
            $table->bigInteger('debt_balance')->nullable();
            $table->integer('acquisition_price_yield')->nullable()->change();
        });
    }
}
