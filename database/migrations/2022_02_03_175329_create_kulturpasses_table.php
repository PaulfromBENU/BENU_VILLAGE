<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKulturpassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('kulturpasses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->onUpdate('cascade')->onDelete('cascade');//->constrained();
            $table->string('file_name');
            $table->boolean('approved')->default('0');
            $table->date('approval_date')->default('2100-01-01');
            $table->date('expiry_date')->default('2100-01-01');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::connection('mysql_common')->table('kulturpasses', function (Blueprint $table) {
        //     $table->dropForeign(['user_id']);
        // });
        Schema::connection('mysql_common')->dropIfExists('kulturpasses');
    }
}
