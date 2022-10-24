<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('keywords', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('keyword_fr');
            $table->string('keyword_lu');
            $table->string('keyword_de');
            $table->string('keyword_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('keywords');
    }
}
