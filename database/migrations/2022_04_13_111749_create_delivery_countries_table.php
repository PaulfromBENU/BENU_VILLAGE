<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('delivery_countries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('country_code');
            $table->string('country_lu');
            $table->string('country_de');
            $table->string('country_en');
            $table->string('country_fr');
            $table->integer('delivery_zone')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->dropIfExists('delivery_countries');
    }
}
