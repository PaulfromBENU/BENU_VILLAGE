<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastConditionsAgreedToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('users', function (Blueprint $table) {
            $table->boolean('last_conditions_agreed')->default('0')->after('legal_ok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->table('users', function (Blueprint $table) {
            $table->dropColumn('last_conditions_agreed');
        });
    }
}
