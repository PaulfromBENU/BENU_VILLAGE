<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionsToCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('creations', function (Blueprint $table) {
            $table->boolean('pillow_option')->default(0);
            $table->boolean('has_set')->default(0);
            $table->integer('set_threshold')->default(4);
            $table->integer('set_discount')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('creations', function (Blueprint $table) {
            $table->dropColumn('pillow_option');
            $table->dropColumn('has_set');
            $table->dropColumn('set_threshold');
            $table->dropColumn('set_discount');
        });
    }
}
