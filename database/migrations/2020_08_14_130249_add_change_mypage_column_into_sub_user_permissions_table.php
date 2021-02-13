<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeMypageColumnIntoSubUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_user_permissions', function (Blueprint $table) {
            $table->boolean('change_mypage')->after('change_plan')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_user_permissions', function (Blueprint $table) {
            $table->dropColumn('change_mypage');
        });
    }
}
