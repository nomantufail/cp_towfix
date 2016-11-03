<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManualimagesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manual_id')->unsigned();
            $table->string('image');
            $table->timestamps();

            $table->foreign('manual_id')
                ->references('id')->on('manuals')
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
        Schema::dropIfExists('manual_images');
    }
}
