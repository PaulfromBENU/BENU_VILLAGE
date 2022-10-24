<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('shops', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('type');
            $table->text('description_de');
            $table->text('description_en');
            $table->text('description_fr');
            $table->text('description_lu');
            $table->string('translation_key')->default('shops.description-')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            //$table->text('opening_time')->nullable();
            $table->string('picture')->nullable();
            $table->string('opening_monday')->default('closed');
            $table->string('opening_tuesday')->default('closed');
            $table->string('opening_wednesday')->default('closed');
            $table->string('opening_thursday')->default('closed');
            $table->string('opening_friday')->default('closed');
            $table->string('opening_saturday')->default('closed');
            $table->string('opening_sunday')->default('closed');
            $table->string('filter_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('shops');
    }
}
