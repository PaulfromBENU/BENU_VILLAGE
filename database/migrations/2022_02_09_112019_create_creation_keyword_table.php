<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreationKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('creation_keyword', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('creation_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('keyword_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('creation_keyword');
    }
}
