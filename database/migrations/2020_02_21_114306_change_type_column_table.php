<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->decimal('area_may_rent', 20 , 2)->charset('')->nullable()->change();
            $table->decimal('area_rent', 20 , 2)->charset('')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->string('area_may_rent')->nullable()->change();
            $table->string('area_rent')->nullable()->change();
        });
    }
}
