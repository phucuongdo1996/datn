<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->text('name_item_3')->nullable()->change();
            $table->text('name_item_12')->nullable()->change();
            $table->text('name_item_13')->nullable()->change();
            $table->text('name_item_14')->nullable()->change();
            $table->text('name_item_15')->nullable()->change();
            $table->text('name_item_16')->nullable()->change();
            $table->text('name_item_20')->nullable()->change();
            $table->text('name_item_24')->nullable()->change();
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
            $table->string('name_item_3')->nullable()->change();
            $table->string('name_item_12')->nullable()->change();
            $table->string('name_item_13')->nullable()->change();
            $table->string('name_item_14')->nullable()->change();
            $table->string('name_item_15')->nullable()->change();
            $table->string('name_item_16')->nullable()->change();
            $table->string('name_item_20')->nullable()->change();
            $table->string('name_item_24')->nullable()->change();
        });
    }
}
