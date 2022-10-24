<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('articles', function (Blueprint $table) {
            $table->integer('size_category')->after('voucher_type')->default('0'); // 0: sent as package, 1: small envelope, 2: large envelope
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('articles', function (Blueprint $table) {
            $table->dropColumn('size_category');
        });
    }
}
