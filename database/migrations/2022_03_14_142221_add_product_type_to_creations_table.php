<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductTypeToCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('creations', function (Blueprint $table) {
            $table->integer('product_type')->after('name')->default('0');//0 : clothe, 1: kid mask, 2: adult mask, 3: other small items
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
            $table->dropColumn('product_type');
        });
    }
}
