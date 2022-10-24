<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('creation_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name_fr');
            $table->string('name_lu');
            $table->string('name_de');
            $table->string('name_en');
            $table->string('translation_key')->default('category.');
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
        Schema::connection('mysql')->dropIfExists('creation_categories');
    }
}
