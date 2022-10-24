<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('family')->default('article'); //radio, article, video, web
            $table->string('title');
            $table->string('language')->default('FR');
            $table->date('publication_date')->nullable();
            $table->string('doc_name')->nullable();
            $table->string('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('media');
    }
}
