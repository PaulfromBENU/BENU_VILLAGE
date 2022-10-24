<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('compositions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fabric_lu');
            $table->string('fabric_en');
            $table->string('fabric_de');
            $table->string('fabric_fr');
            $table->text('explanation_fr');
            $table->text('explanation_lu');
            $table->text('explanation_de');
            $table->text('explanation_en');
            $table->string('translation_key_fabric')->default('fabric.fabric');
            $table->string('translation_key_explanation')->default('fabric.explanation');
            $table->string('picture');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('compositions');
    }
}
