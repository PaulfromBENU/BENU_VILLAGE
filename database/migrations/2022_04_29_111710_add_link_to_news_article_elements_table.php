<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkToNewsArticleElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('news_article_elements', function (Blueprint $table) {
            $table->string('link')->nullable();
            $table->string('link_label_fr')->nullable();
            $table->string('link_label_de')->nullable();
            $table->string('link_label_lu')->nullable();
            $table->string('link_label_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('news_article_elements', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropColumn('link_label_fr');
            $table->dropColumn('link_label_de');
            $table->dropColumn('link_label_lu');
            $table->dropColumn('link_label_en');
        });
    }
}
