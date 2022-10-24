<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('general_conditions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('content_fr');
            $table->text('content_de');
            $table->text('content_lu');
            $table->text('content_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('general_conditions');
    }
}
