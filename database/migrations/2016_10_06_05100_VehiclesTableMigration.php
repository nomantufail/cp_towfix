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
            $table->integer('year')->default(2005);
            $table->integer('year_purchased')->default(2005);
            $table->date('last_service')->default('12-12-12');
            $table->date('next_service')->default('12-12-12');
            $table->string('registration_number')->default('');
            $table->date('registration_expiry')->default('12-12-12');
            $table->string('engine_capacity')->default('');
            $table->integer('number_axles')->default(0);
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
