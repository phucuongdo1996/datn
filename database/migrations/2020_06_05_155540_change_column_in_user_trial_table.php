<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnInUserTrialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_trials', function (Blueprint $table) {
            $table->string('id_subscription')->nullable()->after('user_id');
            $table->tinyInteger('status')->nullable()->after('id_subscription');
        });
        Schema::rename('user_trials', 'user_subscription');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_trials', function (Blueprint $table) {
            $table->dropColumn('id_subscription');
            $table->dropColumn('status');
        });
        Schema::rename('user_subscription', 'user_trials');
    }
}
