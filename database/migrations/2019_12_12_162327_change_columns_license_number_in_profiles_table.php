<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsLicenseNumberInProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->renameColumn('license_number', 'license_address');
            $table->integer('license')->nullable()->after('license_number');
            $table->integer('number_license')->nullable()->after('license');
            $table->string('phone')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->renameColumn('license_address', 'license_number');
            $table->dropColumn('license');
            $table->dropColumn('number_license');
            $table->integer('phone')->change();
        });
    }
}
