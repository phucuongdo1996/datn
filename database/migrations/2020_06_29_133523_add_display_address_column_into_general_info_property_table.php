<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisplayAddressColumnIntoGeneralInfoPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->boolean('display_address')->default(false)->after('display_house_name');
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
            $table->dropColumn('display_address');
        });
    }
}
