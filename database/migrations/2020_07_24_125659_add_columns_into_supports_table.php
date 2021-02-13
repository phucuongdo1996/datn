<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsIntoSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supports', function (Blueprint $table) {
            $table->text('person_in_charge')->nullable()->after('content');
            $table->tinyInteger('state')->nullable()->after('person_in_charge')->comment('1 - not_response, 2 - processing, 3 - processed, 4 - done');
            $table->integer('estimated_amount')->default(0)->after('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supports', function (Blueprint $table) {
           $table->dropColumn('person_in_charge');
           $table->dropColumn('state');
           $table->dropColumn('estimated_amount');
        });
    }
}
