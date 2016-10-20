<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VehiclesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('vehicle_type_id')->unsigned();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('vehicle_type_id')
                ->references('id')->on('vehicle_types')
                ->onDelete('cascade');
            $table->string('make');
            $table->string('model');
            $table->string('year');
            $table->string('year_purchased');
            $table->string('last_service');
            $table->string('next_service');
            $table->string('registration_number');
            $table->string('registration_expiry');
            $table->string('engine_capacity');
            $table->integer('number_axles');
            $table->text('details');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
