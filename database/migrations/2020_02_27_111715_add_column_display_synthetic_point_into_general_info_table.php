<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDisplaySyntheticPointIntoGeneralInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->boolean('display_synthetic_point')->after('display_notes')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->dropColumn('display_synthetic_point');
        });
    }
}
