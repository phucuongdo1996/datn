<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->bigInteger('rent')->default(0);
            $table->bigInteger('key_money')->default(0);
            $table->string('name_item_3')->nullable();
            $table->bigInteger('value_item_3')->default(0);
            $table->bigInteger('total_income')->default(0);
            $table->bigInteger('taxes_dues')->default(0);
            $table->bigInteger('non_life_insurance_premiums')->default(0);
            $table->bigInteger('repair_costs')->default(0);
            $table->bigInteger('depreciation')->default(0);
            $table->bigInteger('borrowing_interest')->default(0);
            $table->bigInteger('payment_rent')->default(0);
            $table->bigInteger('salary_wage')->default(0);
            $table->string('name_item_12')->nullable();
            $table->bigInteger('value_item_12')->default(0);
            $table->string('name_item_13')->nullable();
            $table->bigInteger('value_item_13')->default(0);
            $table->string('name_item_14')->nullable();
            $table->bigInteger('value_item_14')->default(0);
            $table->string('name_item_15')->nullable();
            $table->bigInteger('value_item_15')->default(0);
            $table->string('name_item_16')->nullable();
            $table->bigInteger('value_item_16')->default(0);
            $table->bigInteger('other_expenses')->default(0);
            $table->bigInteger('total_required_expenses')->default(0);
            $table->bigInteger('balance')->default(0);
            $table->string('name_item_20')->nullable();
            $table->bigInteger('value_item_20')->default(0);
            $table->bigInteger('income_amount_before_blue_tax')->default(0);
            $table->bigInteger('tax_return_special_deduction')->default(0);
            $table->bigInteger('income_amount')->default(0);
            $table->string('name_item_24')->nullable();
            $table->bigInteger('value_item_24')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('taxes');
    }
}
