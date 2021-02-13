<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndDropColumnToTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->integer('year');
            $table->integer('month');
            $table->bigInteger('other_income')->default(0);
            $table->bigInteger('maintenance_management_fee')->default(0);
            $table->bigInteger('utilities_expenses')->default(0);
            $table->bigInteger('management_fee')->default(0);
            $table->bigInteger('commission_paid')->default(0);
            $table->bigInteger('loan_loss')->default(0);
            $table->json('property_id')->nullable()->change();
            // drop
            $table->dropColumn('name_item_3');
            $table->dropColumn('value_item_3');
            $table->dropColumn('name_item_12');
            $table->dropColumn('value_item_12');
            $table->dropColumn('name_item_13');
            $table->dropColumn('value_item_13');
            $table->dropColumn('name_item_14');
            $table->dropColumn('value_item_14');
            $table->dropColumn('name_item_15');
            $table->dropColumn('value_item_15');
            $table->dropColumn('name_item_16');
            $table->dropColumn('value_item_16');
            $table->dropColumn('value_item_20');
            $table->dropColumn('income_amount_before_blue_tax');
            $table->dropColumn('tax_return_special_deduction');
            $table->dropColumn('income_amount');
            $table->dropColumn('value_item_24');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('year');
            $table->dropColumn('month');
            $table->dropColumn('other_income');
            $table->dropColumn('maintenance_management_fee');
            $table->dropColumn('utilities_expenses');
            $table->dropColumn('management_fee');
            $table->dropColumn('commission_paid');
            $table->dropColumn('loan_loss');
            $table->integer('property_id')->change();
            // insert
            $table->text('name_item_3')->nullable();
            $table->bigInteger('value_item_3')->default(0);
            $table->text('name_item_12')->nullable();
            $table->bigInteger('value_item_12')->default(0);
            $table->text('name_item_13')->nullable();
            $table->bigInteger('value_item_13')->default(0);
            $table->text('name_item_14')->nullable();
            $table->bigInteger('value_item_14')->default(0);
            $table->text('name_item_15')->nullable();
            $table->bigInteger('value_item_15')->default(0);
            $table->text('name_item_16')->nullable();
            $table->bigInteger('value_item_16')->default(0);
            $table->bigInteger('value_item_20')->default(0);
            $table->bigInteger('income_amount_before_blue_tax')->default(0);
            $table->bigInteger('tax_return_special_deduction')->default(0);
            $table->bigInteger('income_amount')->default(0);
            $table->bigInteger('value_item_24')->default(0);
        });
    }
}
