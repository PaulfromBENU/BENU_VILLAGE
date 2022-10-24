<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->onUpdate('cascade')->nullOnDelete();//->constrained();
            $table->string('address_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('street_number');
            $table->string('street');
            $table->string('floor')->nullable();
            $table->string('zip_code');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->string('other_infos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::connection('mysql_common')->table('addresses', function (Blueprint $table) {
        //     $table->dropForeign(['user_id']);
        // });
        Schema::connection('mysql_common')->dropIfExists('addresses');
    }
}
