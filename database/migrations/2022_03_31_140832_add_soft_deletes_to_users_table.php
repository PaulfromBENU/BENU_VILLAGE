<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('users', function (Blueprint $table) {
            $table->boolean('delete_confirmation')->default('0');
            $table->text('delete_feedback')->nullable();
            $table->softDeletes();
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
            $table->dropColumn('delete_confirmation');
            $table->dropColumn('delete_feedback');
            $table->dropSoftDeletes();
        });
    }
}
