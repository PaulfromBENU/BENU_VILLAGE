<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreationGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('creation_groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name_fr');
            $table->string('name_lu');
            $table->string('name_de');
            $table->string('name_en');
            $table->string('translation_key')->default('type.');
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
        Schema::connection('mysql')->dropIfExists('creation_groups');
    }
}
