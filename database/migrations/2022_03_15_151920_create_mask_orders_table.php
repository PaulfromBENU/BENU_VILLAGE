<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaskOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('mask_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('creation_id')->onUpdate('cascade');
            $table->boolean('with_filter')->default('0');
            $table->boolean('with_cotton')->default('0');
            $table->string('size')->default('small');
            $table->integer('requested_number')->default('1');
            $table->text('text_demand');
            $table->string('email');
            $table->boolean('with_pictures')->default('0');
            $table->boolean('is_read')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('mask_orders');
    }
}
