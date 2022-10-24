<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unique_id')->unique();
            $table->foreignId('cart_id')->onUpdate('cascade');
            $table->foreignId('user_id')->onUpdate('cascade');
            $table->foreignId('address_id')->onUpdate('cascade');
            $table->decimal('total_price', $precision = 6, $scale = 2)->default('0')->nullable();
            $table->integer('status')->default('0');// 0 = created, 1 = payment on-going, 2 = paid, 3 = sent, 4 = cancelled
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->dropIfExists('orders');
    }
}
