<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryStatusToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('orders', function (Blueprint $table) {
            $table->integer('payment_status')->default('0');// 0: no payment needed, 1: payment required, 2: payment received
            $table->integer('delivery_status')->default('0');// 0: no delivery requested, 1: delivery under confirmation, 2: delivery sent, 3: delivery ready for collect in shop, 4: no delivery required
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_status');
            $table->dropColumn('delivery_status');
        });
    }
}
