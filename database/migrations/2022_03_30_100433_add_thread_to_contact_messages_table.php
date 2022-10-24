<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThreadToContactMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('contact_messages', function (Blueprint $table) {
            $table->integer('thread')->after('conditions_ok')->default('1');
            $table->boolean('closed')->after('thread')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('thread');
            $table->dropColumn('closed');
        });
    }
}
