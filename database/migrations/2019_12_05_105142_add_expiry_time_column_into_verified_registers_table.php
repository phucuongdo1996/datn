<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiryTimeColumnIntoVerifiedRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verified_registers', function (Blueprint $table) {
            $table->dateTime('expiry_time')->comment('Expiry time active')
                ->after('verified_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verified_registers', function (Blueprint $table) {
            $table->dropColumn('expiry_time');
        });
    }
}
