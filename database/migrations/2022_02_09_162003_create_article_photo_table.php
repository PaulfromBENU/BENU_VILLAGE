<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('article_photo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('article_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('photo_id')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('article_photo');
    }
}
