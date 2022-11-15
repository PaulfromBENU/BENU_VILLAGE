<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_village')->create('village_info_elements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('village_info_id')->onUpdate('cascade');
            $table->integer('position')->default('0');
            $table->integer('type')->default('0');
            $table->text('content_fr');
            $table->text('content_en');
            $table->text('content_de');
            $table->text('content_lu');
            $table->string('photo_file_name')->nullable();
            $table->string('photo_alt')->nullable();
            $table->string('photo_title')->nullable();
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
        Schema::connection('mysql_village')->dropIfExists('village_info_elements');
    }
};
