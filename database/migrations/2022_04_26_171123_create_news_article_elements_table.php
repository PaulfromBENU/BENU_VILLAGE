<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsArticleElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('news_article_elements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('news_article_id')->onUpdate('cascade');
            $table->integer('position')->default('0');
            $table->integer('type')->default('0');
            $table->text('content_fr');
            $table->text('content_en');
            $table->text('content_de');
            $table->text('content_lu');
            $table->string('photo_file_name')->nullable();
            $table->string('photo_alt')->nullable();
            $table->string('photo_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('news_article_elements');
    }
}
