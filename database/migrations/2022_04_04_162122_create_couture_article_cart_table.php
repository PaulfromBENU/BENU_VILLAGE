<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoutureArticleCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('couture_article_cart', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('article_id')->onUpdate('cascade');
            $table->foreignId('cart_id')->onUpdate('cascade');
            $table->boolean('is_gift')->default('0');
            $table->boolean('with_wrapping')->default('0');
            $table->boolean('with_card')->default('0');
            $table->integer('card_type')->default('0')->nullable();
            $table->boolean('with_message')->default('0');
            $table->text('message')->nullable();
            $table->boolean('with_extra_article')->default('0');// For extra pillow for example
            $table->integer('articles_number')->default('1');
            $table->decimal('value', $precision = 6, $scale = 2)->default('30');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->dropIfExists('couture_article_cart');
    }
}
