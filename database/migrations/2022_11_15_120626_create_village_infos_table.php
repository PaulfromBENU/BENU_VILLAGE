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
        Schema::connection('mysql_village')->create('village_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title_fr')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_de')->nullable();
            $table->string('title_lu')->nullable();
            $table->string('slug_fr')->nullable();
            $table->string('slug_en')->nullable();
            $table->string('slug_de')->nullable();
            $table->string('slug_lu')->nullable();
            $table->string('main_photo');
            $table->string('main_photo_title')->nullable();
            $table->string('main_photo_alt')->nullable();
            $table->string('tag_1_fr')->nullable();
            $table->string('tag_1_en')->nullable();
            $table->string('tag_1_de')->nullable();
            $table->string('tag_1_lu')->nullable();
            $table->string('tag_2_fr')->nullable();
            $table->string('tag_2_en')->nullable();
            $table->string('tag_2_de')->nullable();
            $table->string('tag_2_lu')->nullable();
            $table->string('tag_3_fr')->nullable();
            $table->string('tag_3_en')->nullable();
            $table->string('tag_3_de')->nullable();
            $table->string('tag_3_lu')->nullable();
            $table->string('summary_fr')->nullable();
            $table->string('summary_en')->nullable();
            $table->string('summary_de')->nullable();
            $table->string('summary_lu')->nullable();
            $table->string('seo_title_fr')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_title_de')->nullable();
            $table->string('seo_title_lu')->nullable();
            $table->string('seo_desc_fr')->nullable();
            $table->string('seo_desc_en')->nullable();
            $table->string('seo_desc_de')->nullable();
            $table->string('seo_desc_lu')->nullable();
            $table->boolean('is_ready')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_village')->dropIfExists('village_infos');
    }
};
