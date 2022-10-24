<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagsToNewsArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('news_articles', function (Blueprint $table) {
            $table->string('tag_3_fr')->after('tag_2_lu')->nullable();
            $table->string('tag_3_en')->after('tag_3_fr')->nullable();
            $table->string('tag_3_de')->after('tag_3_en')->nullable();
            $table->string('tag_3_lu')->after('tag_3_de')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('news_articles', function (Blueprint $table) {
            $table->dropColumn('tag_3_fr');
            $table->dropColumn('tag_3_en');
            $table->dropColumn('tag_3_de');
            $table->dropColumn('tag_3_lu');
        });
    }
}
