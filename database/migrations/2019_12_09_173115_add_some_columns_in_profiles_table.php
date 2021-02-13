<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsInProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->renameColumn('person_charge_name', 'person_charge_first_name');
            $table->renameColumn('person_charge_name_kana', 'person_charge_first_name_kana');
            $table->renameColumn('company_representative', 'company_representative_first_name');
            $table->renameColumn('trader', 'specialty');
            $table->string('person_charge_last_name')->nullable()->after('person_charge_name');
            $table->string('person_charge_last_name_kana')->nullable()->after('person_charge_name_kana');
            $table->string('division')->nullable()->after('company_name');
            $table->string('company_representative_last_name')->nullable()->after('company_representative');
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
            $table->renameColumn('person_charge_first_name', 'person_charge_name');
            $table->renameColumn('person_charge_first_name_kana', 'person_charge_name_kana');
            $table->renameColumn('company_representative_first_name', 'company_representative');
            $table->renameColumn('specialty', 'trader');
            $table->dropColumn('person_charge_last_name');
            $table->dropColumn('person_charge_last_name_kana');
            $table->dropColumn('division');
            $table->dropColumn('company_representative_last_name');
        });
    }
}
