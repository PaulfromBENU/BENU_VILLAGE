<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReadColumnToContactMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('contact_messages', function (Blueprint $table) {
            $table->boolean('is_read')->default('0');
            $table->boolean('is_answered')->default('0');
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
            $table->dropColumn('is_read');
            $table->dropColumn('is_answered');
        });
    }
}
