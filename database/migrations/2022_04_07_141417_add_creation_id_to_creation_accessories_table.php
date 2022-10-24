<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreationIdToCreationAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('creation_accessories', function (Blueprint $table) {
            $table->foreignId('creation_id')->after('updated_at')->onUpdate('cascade');
            $table->decimal('price', $precision = 6, $scale = 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('creation_accessories', function (Blueprint $table) {
            $table->dropColumn('creation_id');
            $table->dropColumn('price');
        });
    }
}
