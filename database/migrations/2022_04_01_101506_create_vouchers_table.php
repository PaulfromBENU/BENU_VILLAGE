<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unique_code')->unique();
            $table->foreignId('user_id')->onUpdate('cascade')->nullable();
            $table->decimal('initial_value', $precision = 6, $scale = 2)->default('0');
            $table->decimal('remaining_value', $precision = 6, $scale = 2)->default('0');
            $table->dateTime('expires_on')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->dropIfExists('vouchers');
    }
}
