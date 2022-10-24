<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_common')->create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('last_login')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->default('newsletter');//5 levels: newsletter (not registered, just newsletter), user, editor, vendor, admin
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('company')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_over_18')->default('0');
            $table->boolean('legal_ok')->default('0');
            $table->boolean('newsletter')->default('0');
            $table->string('origin')->nullable();
            $table->string('badge')->default('standard');
            $table->string('client_number')->unique();
            $table->string('rating')->default('10');
            $table->text('general_comment');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_common')->dropIfExists('users');
    }
}
