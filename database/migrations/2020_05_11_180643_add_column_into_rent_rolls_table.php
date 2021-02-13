<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIntoRentRollsTable extends Migration
{
    /**
     * Run the migrations file.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_rolls', function (Blueprint $table) {
            $table->integer('year')->nullable()->after('note');
            $table->integer('month')->nullable()->after('year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_rolls', function (Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('month');
        });
    }
}
