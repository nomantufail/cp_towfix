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
            $table->string('vehicle_type')->default("");
            $table->timestamps();
            $table->string('make');
            $table->string('model');
            $table->integer('year')->default(2005);
            $table->integer('year_purchased')->default(2005);
            $table->dateTime('last_service')->default('12-12-12');
            $table->dateTime('next_service')->default('12-12-12');
            $table->string('registration_number')->default('');
            $table->date('registration_expiry')->default('12-12-12');
            $table->string('engine_capacity')->default('');
            $table->integer('number_axles')->default(0);
            $table->text('details');

            $table->foreign('customer_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

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
