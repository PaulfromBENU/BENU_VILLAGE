<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AddReturnToCoutureArticleCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->table('couture_article_cart', function (Blueprint $table) {
            $table->boolean('is_returned')->default('0');
            $table->date('return_date')->default(Carbon::now());
            $table->integer('return_status')->default('0');// 0: not requested, 1: waiting for recepetion, 2: received
            $table->integer('return_payment_status')->default('0');// 0: not paid, 1: payment on-going, 2: article refund completed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->table('couture_article_cart', function (Blueprint $table) {
            $table->dropColumn('is_returned');
            $table->dropColumn('return_date');
            $table->dropColumn('return_status');
            $table->dropColumn('return_payment_status');
        });
    }
}
