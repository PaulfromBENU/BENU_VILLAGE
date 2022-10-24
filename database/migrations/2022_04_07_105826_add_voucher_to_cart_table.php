<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVoucherToCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('carts', function (Blueprint $table) {
            $table->boolean('use_voucher')->default('0');
            $table->string('voucher_code')->default("")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->table('carts', function (Blueprint $table) {
            $table->dropColumn('use_voucher');
            $table->dropColumn('voucher_code');
        });
    }
}
