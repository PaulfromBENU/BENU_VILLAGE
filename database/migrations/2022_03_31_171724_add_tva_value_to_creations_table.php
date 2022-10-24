<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTvaValueToCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('creations', function (Blueprint $table) {
            $table->decimal('tva_value', $precision = 6, $scale = 2)->after('price')->default('17');
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
            $table->dropColumn('tva_value');
        });
    }
}
