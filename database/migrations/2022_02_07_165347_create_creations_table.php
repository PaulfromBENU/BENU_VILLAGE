<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('creations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            //$table->foreignId('creation_group_id')->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('creation_category_id')->onUpdate('cascade')->nullOnDelete()->nullable();
            //$table->string('gender')->nullable();
            $table->boolean('is_accessory')->default('0');
            $table->decimal('price', $precision = 6, $scale = 2)->default('0');
            $table->integer('weight')->default('0');
            $table->boolean('requires_size')->default('1');
            $table->text('description_lu')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_de')->nullable();
            $table->string('translation_key')->default('models.description-creationname')->nullable();
            $table->string('origin_link_fr')->nullable();
            $table->string('origin_link_lu')->nullable();
            $table->string('origin_link_de')->nullable();
            $table->string('origin_link_en')->nullable();
            $table->boolean('rental_enabled')->default('0');
            $table->foreignId('partner_id')->onUpdate('cascade')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('creations');
    }
}
