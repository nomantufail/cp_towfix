<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name')->default('');
            $table->string('l_name')->default('');
            $table->string('address')->default('');
            $table->string('phone_number')->default('444');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('role')->default(3); //1: admin, 2: frenchise 3: customer
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
