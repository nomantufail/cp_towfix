<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VehicleSrvReqFormsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_srv_req_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cust_vehicle_srv_reqs_id')->unsigned();
            $table->text('document');
            $table->timestamps();

            $table->foreign('cust_vehicle_srv_reqs_id')
                ->references('id')->on('cust_vehicle_srv_reqs')
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
        Schema::dropIfExists('vehicle_srv_req_forms');
    }
}
