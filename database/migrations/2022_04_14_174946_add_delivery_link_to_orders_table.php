<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AddDeliveryLinkToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('orders', function (Blueprint $table) {
            $table->string('delivery_link')->nullable();
            $table->date('delivery_date')->default(Carbon::now());
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
            $table->dropColumn('delivery_link');
            $table->dropColumn('delivery_date');
        });
    }
}
