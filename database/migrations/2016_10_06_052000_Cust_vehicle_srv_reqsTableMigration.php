<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustVehicleSrvReqsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cust_vehicle_srv_reqs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned()->index();
            $table->integer('franchise_id')->unsigned()->index();
            $table->integer('work_type_id')->unsigned()->index();
            $table->dateTime('suggested_date');
            $table->integer('suggested_by')->unsigned();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('vehicle_id')
                ->references('id')->on('vehicles')
                ->onDelete('cascade');

            $table->foreign('suggested_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('franchise_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('work_type_id')
                ->references('id')->on('work_types')
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
        Schema::dropIfExists('cust_vehicle_srv_reqs');
    }
}
