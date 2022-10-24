<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cart_id')->unique();
            $table->boolean('is_active')->default('0');
            // $table->string('session_id')->unique();
            $table->foreignId('user_id')->onUpdate('cascade')->nullable();
            $table->integer('status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->dropIfExists('carts');
    }
}
